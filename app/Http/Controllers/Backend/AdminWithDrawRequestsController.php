<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\WithDrawRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\WithDrawRequest;
use Illuminate\Http\Request;

class AdminWithDrawRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WithDrawRequestDataTable $withDrawRequestDataTable)
    {
        return $withDrawRequestDataTable->render('admin.with-draw-request.index');
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
        $request = WithDrawRequest::findOrFail($id);
        return view('admin.with-draw-request.show',compact('request'));
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

    function ChangeStatus(Request $request,$id){
        $request->validate([
            'status' => ['required','in:paid,pending,declined']
        ]);
        $withDraw = WithDrawRequest::findOrFail($id);
        $withDraw->status = $request->status;
        $withDraw->save();
        toastr('Status has been Changed Successfully',);
        return redirect()->back();
    }
}
