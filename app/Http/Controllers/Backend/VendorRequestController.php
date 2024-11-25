<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorCondition;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;

class VendorRequestController extends Controller
{
    function index(VendorRequestDataTable $vendorRequestDataTable) {
        return $vendorRequestDataTable->render('admin.vendor-request.index');
    }

    function ChangeStatus(Request $request,$id) {
         $request->validate([
             'status' => ['required','boolean'],
         ]);
         $vendor = Vendor::findOrFail($id);
         $vendor->status = $request->status;
         $vendor->save();

        if($request->status == 1){
            $user = User::findOrFail($vendor->user_id);
            $user->role = 'vendor';
            $user->save();
        }
         toastr('Status Saved Successfully');
         return redirect()->back();
       }

    function show($id) {
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendor-request.show',compact('vendor'));
      }

    function VendorCondition(){
        $content = VendorCondition::first();
        return view('admin.vendor-request.conditions',compact('content'));
      }

      function VendorConditionSubmit(Request $request){
        $request->validate([
            'content' =>['required'],
        ]);
        VendorCondition::updateOrCreate(
            ['id' => 1],
            ['content' => $request->content],
        );

        toastr('Condition Saved Successfully');
        return redirect()->back();
      }
}
