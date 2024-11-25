<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\VendorProfileUpdateReqeust;
use App\Models\User;
use App\Models\Vendor;
use App\Traits\upload_file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorProfileController extends Controller
{
    use upload_file;
    public function index()
    {
        $user = Vendor::where('user_id',Auth::user()->id)->first();
        return view('admin.vendor-profile.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vendor-profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorProfileUpdateReqeust $request)
    {
        // Find the vendor by ID or fail
        $vendor = Vendor::where('user_id',$request->user_id)->first();
        $banner =$this->uploadFile($request,'banner',$vendor->banner);
        // Update the vendor's attributes
        $vendor->phone = $request->input('phone');
        $vendor->email = $request->input('email');
        $vendor->banner = isset($banner) ? $banner : $vendor->banner;
        $vendor->address = $request->input('address');
        $vendor->description = $request->input('description');
        $vendor->fb_link = $request->input('fb_link');
        $vendor->tw_link = $request->input('tw_link');
        $vendor->insta_link = $request->input('insta_link');
        $vendor->user_id = $request->input('user_id');
        $vendor->status = $request->input('status');
        $vendor->save();
        toastr("Data Saved Successfully");
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorProfileUpdateReqeust $request, string $id)
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
}
