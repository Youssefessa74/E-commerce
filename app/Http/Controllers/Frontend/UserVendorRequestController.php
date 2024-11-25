<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorCondition;
use App\Traits\upload_file;
use Illuminate\Http\Request;

class UserVendorRequestController extends Controller
{
    use upload_file;
    function index(){
        $content = VendorCondition::first();
        return view('frontend.dashboard.vendor-request.index',compact('content'));
    }
    function create(Request $request){
        $request->validate([
            'shop_image' => ['required','image','max:1000'],
            'shop_name'=>['required','max:200'],
            'shop_email'=>['required','email'],
            'shop_phone' =>['required'],
            'shop_address'=>['required','max:200'],
            'about'=> ['required'],
        ]);
        $image = $this->uploadFile($request,'shop_image');
        $vendor = new Vendor();
        $vendor->shop_name = $request->shop_name;
        $vendor->banner = $image;
        $vendor->phone = $request->shop_phone;
        $vendor->email = $request->shop_email;
        $vendor->address = $request->shop_address;
        $vendor->description = $request->about;
        $vendor->user_id = auth()->user()->id;
        $vendor->status = 0;
        $vendor->save();
        toastr('Data Saved Succeessfully And Waiting To Be Approved By Admin');
        return redirect()->back();
    }
}
