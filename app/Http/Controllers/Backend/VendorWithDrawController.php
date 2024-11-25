<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorWithDrawDataTable;
use App\Http\Controllers\Controller;
use App\Models\VendorWithDraw;
use Illuminate\Http\Request;

class VendorWithDrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorWithDrawDataTable $vendorWithDrawDataTable)
    {
        return $vendorWithDrawDataTable->render('admin.with-draw.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.with-draw.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:255'],
            'minimum_amount' => ['required','numeric','lt:maximum_amount'],
            'maximum_amount' => ['required','numeric','gt:minimum_amount'],
            'withdraw_charge' =>['required','numeric'],
            'description' => ['required'],
        ]);
        $method = new VendorWithDraw();
        $method->name = $request->name;
        $method->minimum_amount = $request->minimum_amount;
        $method->maximum_amount = $request->maximum_amount;
        $method->withdraw_charge = $request->withdraw_charge;
        $method->description = $request->description;
        $method->save();
        toastr('Data Saved Successfully','success');
        return to_route('admin.with-draws.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $method = VendorWithDraw::findOrFail($id);
        return view('admin.with-draw.edit',compact('method'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','max:255'],
            'minimum_amount' => ['required','numeric','lt:maximum_amount'],
            'maximum_amount' => ['required','numeric','gt:minimum_amount'],
            'withdraw_charge' =>['required','numeric'],
            'description' => ['required'],
        ]);
        $method =  VendorWithDraw::findOrFail($id);
        $method->name = $request->name;
        $method->minimum_amount = $request->minimum_amount;
        $method->maximum_amount = $request->maximum_amount;
        $method->withdraw_charge = $request->withdraw_charge;
        $method->description = $request->description;
        $method->save();
        toastr('Data Saved Successfully','success');
        return to_route('admin.with-draws.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       VendorWithDraw::findOrFail($id)->delete();
       toastr('Data Deleted Successfully','success');
       return to_route('admin.with-draws.index');
    }
}
