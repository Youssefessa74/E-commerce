<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorListDataTable;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorListController extends Controller
{
    function index(VendorListDataTable $customerListDataTable){
        return $customerListDataTable->render('admin.users-list.vendors');
    }

    function ChangeStatus(Request $request) {
        $request->validate([
            'status' => ['required','boolean'],
        ]);
        $user = Vendor::findOrFail($request->id);
        $user->status = !$request->status ;
        $user->save();
        return response(['status' => 'success'],200);

    }
}
