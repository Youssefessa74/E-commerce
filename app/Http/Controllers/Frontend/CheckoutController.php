<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShippingRule;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session ;

class CheckoutController extends Controller
{
    function index() {
        $user = Auth::user();
        $shipping = ShippingRule::where('status',1)->get();
        $userAddresses = UserAddress::where('user_id',$user->id)->get();
        
        return view('frontend.pages.checkout',compact('userAddresses','shipping'));
    }

    function CreateNewAddress(Request $request) {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'max:200', 'email'],
            'phone' => ['required', 'max:200'],
            'country' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'zip' => ['required', 'max:200'],
            'address' => ['required'],
        ]);

        $address = new UserAddress();
        $address->user_id = $request->user_id;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->country = $request->country;
        $address->city = $request->city;
        $address->zip = $request->zip;
        $address->address = $request->address;
        $address->save();

        toastr('Created Successfully!', 'success', 'Success');

        return redirect()->back();
    }

    function Checkout(Request $request){
        $request->validate([
            'shipping_method_id' => ['required','integer','exists:shipping_rules,id'],
            'shipping_address_id' => ['required','integer','exists:user_addresses,id'],
        ]);
        $shipping = ShippingRule::findOrFail($request->shipping_method_id);
        if($shipping){
            Session::put('shipping_method',[
                'id' => $shipping->id,
                'name' => $shipping->name,
                'type' => $shipping->type,
                'cost' => $shipping->cost,
            ]);
        }
        $address = UserAddress::findOrFail($request->shipping_address_id)->toArray();
        if($address){
            Session::put('address',$address);
        }
        return response(['status'=>'success','redirect_url'=>route('payment.page')],200);
    }
}
