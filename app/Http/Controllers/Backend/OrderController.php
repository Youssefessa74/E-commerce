<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CanceledDataTable;
use App\DataTables\DeliveredDataTable;
use App\DataTables\DroppedOffDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\OutForDeliveryDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\ProcessedAndReadyToShipDataTable;
use App\DataTables\ShippedDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $orderDataTable)
    {
        return $orderDataTable->render('admin.orders.all_orders');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show',compact('order'));
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
        $order = Order::findOrFail($id);
        $order->OrderProducts()->delete();
        $order->transaction()->delete();
        $order->delete();
        toastr('Order Deleted Successfully');
        return redirect()->back();
    }

    function OrderChangeStatus(Request $request) {
        $request->validate([
            'orderId' => ['required','exists:orders,id'],
            'orderStatus' => ['required'],
        ]);
        $order = Order::findOrFail($request->orderId);
        $order->order_status = $request->orderStatus;
        $order->save();
        return response(['status'=>'success','message' => 'Order Status Updated Successfully'],200);
    }

    function PaymentChangeStatus(Request $request) {
        $request->validate([
            'orderId' => ['required','exists:orders,id'],
            'paymentStatus' => ['required'],
        ]);
        $order = Order::findOrFail($request->orderId);
        $order->payment_status = $request->paymentStatus;
        $order->save();
        return response(['status'=>'success','message' => 'Order Status Updated Successfully'],200);
    }

    function PendingOrders(PendingOrderDataTable $pendingOrderDataTable){
        return $pendingOrderDataTable->render('admin.orders.pending_orders');
    }
    function ProcessedAndReadyToShip(ProcessedAndReadyToShipDataTable $OrderDataTable){
        return $OrderDataTable->render('admin.orders.processed_and_ready_to_ship_orders');
    }
    function DroppedOff(DroppedOffDataTable $OrderDataTable){
        return $OrderDataTable->render('admin.orders.dropped_off_orders');
    }
    function ShippedOrders(ShippedDataTable $OrderDataTable){
        return $OrderDataTable->render('admin.orders.shipped_orders');
    }
    function OutForDeliveryOrders(OutForDeliveryDataTable $OrderDataTable){
        return $OrderDataTable->render('admin.orders.out_for_delivery_orders');
    }
    function DeliveredOrders(DeliveredDataTable $OrderDataTable){
        return $OrderDataTable->render('admin.orders.delivered_orders');
    }
    function CanceledOrders(CanceledDataTable $OrderDataTable){
        return $OrderDataTable->render('admin.orders.canceled_orders');
    }
}
