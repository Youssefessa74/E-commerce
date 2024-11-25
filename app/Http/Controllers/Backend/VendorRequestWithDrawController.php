<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\VendorWithDraw;
use App\Models\WithDrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VendorRequestWithDrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalBalance = OrderProduct::where('vendor_id', auth()->user()->vendor->id)->whereHas('order', function ($query) {
            $query->where(['order_status' => 'delivered', 'payment_status' => 1]);
        })->sum(DB::raw('unit_price * qty + variant_total'));
        $withDrawAmount = WithDrawRequest::where('status', 'paid')->sum('total_amount');
        $currentBalance = $totalBalance - $withDrawAmount;
        $pendingWithDrawAmount = WithDrawRequest::where('status', 'pending')->sum('total_amount');
        $withdraw = WithDrawRequest::where('vendor_id', auth()->user()->id)->paginate(10);
        return view('vendor.with-draw.index', compact('withdraw', 'currentBalance', 'pendingWithDrawAmount', 'withDrawAmount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $methods = VendorWithDraw::all();
        return view('vendor.with-draw.create', compact('methods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'method' => ['required', 'integer'],
            'amount' => ['required', 'numeric'],
            'account_info' => ['required', 'max:2000']
        ]);

        $method = VendorWithDraw::findOrFail($request->method);
        $totalBalance = OrderProduct::where('vendor_id', auth()->user()->vendor->id)->whereHas('order', function ($query) {
            $query->where(['order_status' => 'delivered', 'payment_status' => 1]);
        })->sum(DB::raw('unit_price * qty  + variant_total'));
        $withDrawAmount = WithDrawRequest::where('status', 'paid')->sum('total_amount');
        $currentBalance = $totalBalance - $withDrawAmount;
        if ($request->amount > $currentBalance) {
            throw ValidationException::withMessages(['The Amount Should be less that the current balance And Your Currenct Balance Is' . $currentBalance]);
        }
        if ($request->amount > $totalBalance) {
            throw ValidationException::withMessages(["The amount have to be less than Your Current Balance"]);
        }

        if (WithDrawRequest::where(['status' => 'pending', 'vendor_id' => auth()->user()->id])->exists()) {
            throw ValidationException::withMessages(["You Already have a pending request"]);
        }

        if ($request->amount < $method->minimum_amount && $request->amount > $method->maximum_amount) {
            throw ValidationException::withMessages(["The amount have to be getter then $method->minimum_amount and less then $method->maximum_amount"]);
        }


        $withdraw = new WithdrawRequest();
        $withdraw->vendor_id = auth()->user()->id;
        $withdraw->method = $method->name;
        $withdraw->total_amount = $request->amount;
        $withdraw->withdraw_amount = $request->amount - ($method->withdraw_charge / 100) * $request->amount;
        $withdraw->withdraw_charge = ($method->withdraw_charge / 100) * $request->amount;
        $withdraw->account_info = $request->account_info;
        $withdraw->save();
        toastr('Request added successfully');
        return redirect()->route('vendor.request-with-draw.index');
    }


    public function show(string $id)
    {
        $method = VendorWithDraw::findOrFail($id);
        return response($method);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function ShowWithDrawRequest($id)
    {
        $withdraw = WithDrawRequest::findOrFail($id);
        return view('vendor.with-draw.show', compact('withdraw'));
    }
}
