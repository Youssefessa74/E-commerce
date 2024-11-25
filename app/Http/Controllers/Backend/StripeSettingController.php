<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class StripeSettingController extends Controller
{
    function update(Request $request,$id){
        $request->validate([
            'status' => ['required', 'integer'],
            'mode' => ['required', 'integer'],
            'country' => ['required', 'max:200'],
            'currency_name' => ['required', 'max:200'],
            'currency_rate' => ['required'],
            'client_id' => ['required'],
            'secret_key' => ['required']
        ]);
        $stripe = StripeSetting::updateOrCreate(
            ['id'=>1],
            [
                'status' => $request->status,
                'mode' => $request->mode,
                'country' => $request->country,
                'currency_name' => $request->currency_name,
                'currency_rate' => $request->currency_rate,
                'client_id' => $request->client_id,
                'secret_key' => $request->secret_key
        ],
        );
        toastr('Data Saved Successfully','success');
        return redirect()->back();
    }
}
