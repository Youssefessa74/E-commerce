<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminListDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    function index(AdminListDataTable $adminListDataTable){
        return $adminListDataTable->render('admin.users-list.admins');
    }

    function ChangeStatus(Request $request) {
        $request->validate([
            'status' => ['required'],
        ]);
        $user = User::findOrFail($request->id);
        $user->status = $request->status ;
        $user->save();
        return response(['status' => 'success'],200);

    }

    function destroy($id){
        $admin = User::findOrFail($id)->delete();
        $products = Product::where('user_id',$id)->get();
        if(count($products) > 0){
            return response(['status' =>['error','message' => 'Admin Can not be deleted as he has products in our sites ,please delete the product first']],422);
        }
        Vendor::where('user_id',$id)->delete();
        $admin->delete();
        toastr('Admin Deleted Successfully');
        return redirect()->back();
    }
}
