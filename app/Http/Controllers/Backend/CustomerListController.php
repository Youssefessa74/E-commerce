<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CustomerListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerListController extends Controller
{
    function index(CustomerListDataTable $customerListDataTable){
        return $customerListDataTable->render('admin.users-list.customers');
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
}
