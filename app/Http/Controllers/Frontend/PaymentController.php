<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CashOnDelivery;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Cart;
use Illuminate\Support\Str;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    function index()
    {
        if (!Session::has('address')) {
            return redirect()->route('checkout');
        }
        return view('frontend.pages.payment');
    }

    public function CreateOrder($paymentMethod, $paymentStatus, $transactionId, $paidAmount, $paidCurrencyName)
    {
        try {
            $setting = GeneralSetting::first();

            $order = new Order();
            $order->invoice_id = rand(1, 999999);
            $order->user_id = Auth::user()->id;
            $order->sub_total = CartTotal();
            $order->amount = GetFinalPaymentTotal();
            $order->currency_name = $setting->currency_name;
            $order->currency_icon = $setting->currency_icon;
            $order->product_qty = Cart::content()->count();
            $order->payment_method = $paymentMethod;
            $order->payment_status = $paymentStatus;
            $order->order_address = json_encode(Session::get('address'));
            $order->shpping_method = json_encode(Session::get('shipping_method'));
            $order->coupon = json_encode(Session::get('coupon'));
            $order->order_status = 'pending';
            $order->save();

            // store order products
            foreach (Cart::content() as $item) {
                $product = Product::find($item->id);
                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $product->id;
                $orderProduct->vendor_id = $product->vendor_id;
                $orderProduct->product_name = $product->name;
                $orderProduct->variants = json_encode($item->options->variants);
                $orderProduct->variant_total = $item->options->variants_total;
                $orderProduct->unit_price = $item->price;
                $orderProduct->qty = $item->qty;
                $orderProduct->save();

                // update product quantity
                $updatedQty = ($product->qty - $item->qty);
                $product->qty = $updatedQty;
                $product->save();
            }

            // store transaction details
            $transaction = new Transaction();
            $transaction->order_id = $order->id;
            $transaction->transaction_id = $transactionId;
            $transaction->payment_method = $paymentMethod;
            $transaction->amount = GetFinalPaymentTotal();
            $transaction->amount_real_currency = $paidAmount;
            $transaction->amount_real_currency_name = $paidCurrencyName;
            $transaction->save();

            Log::info('Order created successfully', ['order_id' => $order->id]);
        } catch (\Exception $e) {
            Log::error('Error while creating order: ' . $e->getMessage());
            throw $e; // Optionally rethrow the exception
        }
    }

    /* Paypal Functions */
    function PaypalConfig()
    {
        $paypal = PaypalSetting::first();

        if (!$paypal || !$paypal->client_id || !$paypal->secret_key) {
            // Handle the missing credentials case (e.g., log the error or throw an exception)
            throw new \Exception('PayPal credentials are missing from the database.');
        }

        $config = [
            'mode'    => $paypal->mode == 1 ? 'live' : 'sandbox',
            'sandbox' => [
                'client_id'         => $paypal->client_id,
                'client_secret'     => $paypal->secret_key,
                'app_id'            => 'APP-80W284485P519543T',  // Optional, replace if needed
            ],
            'live' => [
                'client_id'         => $paypal->client_id,
                'client_secret'     => $paypal->secret_key,
                'app_id'            => '',  // Optional, replace if needed
            ],
            'payment_action' => 'Sale',
            'currency'       => $paypal->currency_name,
            'notify_url'     => '',  // Set if needed
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];

        // Debug to check if the configuration is correct
        Log::info('PayPal Configuration: ', $config);

        return $config;
    }

    function PayWithPaypal()
    {
        $paypal = PaypalSetting::first();
        // Calc The amount based on currency rate
        $total = GetFinalPaymentTotal();
        $paypalAmount = round($total * $paypal->currency_rate, 2);
        // End Calc The amount based on currency rate
        $config = $this->PaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $paypalAmount,
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('paypal.cancel');
        }
    }

    function PaypalCancel()
    {
        return 'Cancel Paypal';
    }
    function PaypalSuccess(Request $request)
    {
        $config = $this->PaypalConfig();
        $provider = new PayPalClient($config);

        try {
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request->token);

            Log::info('PayPal response', ['response' => $response]);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                $paypal = PaypalSetting::first();
                $total = GetFinalPaymentTotal();
                $paidAmount = round($total * $paypal->currency_rate, 2);
                $this->CreateOrder('paypal', 1, $response['id'], $paidAmount, $paypal->currency_name);
                $this->clearSession();
                return redirect()->route('payment.success');
            } else {
                Log::warning('PayPal payment not completed', ['response' => $response]);
                return redirect()->route('paypal.cancel');
            }
        } catch (\Exception $e) {
            Log::error('PayPal error: ' . $e->getMessage());
            return redirect()->route('paypal.cancel');
        }
    }

    // End Paypal Functions
    /* Stripe Functions*/
    function PayWithStripe(Request $request){
        $stripe = StripeSetting::first();
        // Calc The amount based on currency rate
        $total = GetFinalPaymentTotal();
        $payableAmount = round($total * $stripe->currency_rate, 2);
        // End Calc The amount based on currency rate
        Stripe::setApiKey($stripe->secret_key);
        $response =  Charge::create([
            'amount' => $payableAmount *100 , // We Have to convert dollar into cents
            'currency' => $stripe->currency_name,
            'source' => $request->stripe_token,
            'description' => 'Payment Test',
        ]);
        if($response['status'] == 'succeeded'){
            $this->CreateOrder('stripe', 1, $response['id'], $payableAmount, $stripe->currency_name);
            $this->clearSession();
            return redirect()->route('payment.success');
        }else {
            Log::warning('PayPal payment not completed', ['response' => $response]);
            return redirect()->route('paypal.cancel');
        }
    }
    // End Stripe Functions


    function PaymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }
    function ClearSession(){
        Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_method');
        Session::forget('coupon');

    }

    function CashOnDelivery(Request $request) {
        $cash = CashOnDelivery::first();
        $settings = GeneralSetting::first();
        if($cash->status == 0){
            toastr('Sorry,this method is not available in your area','error');
            return redirect()->back();
        }
        $total = GetFinalPaymentTotal();
        $payableAmount = round($total,2);

        $this->CreateOrder('Cash On Delivery',0,Str::random(10),$payableAmount,$settings->currency_name);
        $this->ClearSession();
        return redirect()->route('payment.success');
    }
}
