<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\VendorUpdatePassword;
use App\Models\Order;
use App\Models\User;
use App\Traits\upload_file;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class VendorProfileController extends Controller
{
    use upload_file;
    function VendorProfile(){

        return view('vendor.dashboard.sections.myprofile');
    }

    function UpdateVendorProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:500'],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($request->id)
            ],
        ]);
        $user = User::findOrFail($request->id);
        $image = $this->uploadFile($request, 'image', $user->image);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = isset($image) ? $image : $user->image;
        $user->save();

        toastr('User Data Saved Successfully');
        return redirect()->back();
    }

    function UpdateVendorPassword(VendorUpdatePassword $request){
        $user = User::findOrFail($request->id);
        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Optionally, you can redirect with a success message
        toastr('Password updated successfully', 'success');
        return redirect()->back();
    }
}
