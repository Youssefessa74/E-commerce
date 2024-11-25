<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CashOnDelivery;
use Illuminate\Http\Request;

class CashOnDeliveryContoller extends Controller
{
    function update(Request $request){
        $request->validate(['status' => ['required','boolean']]);
        CashOnDelivery::updateOrCreate(
            ['id' => 1],
            ['status' => $request->status],
        );
        toastr('Data Saved Successfully','success');
        return redirect()->back();
    }
}
