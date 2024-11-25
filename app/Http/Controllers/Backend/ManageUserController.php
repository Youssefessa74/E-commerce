<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\NewUserMail;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ManageUserController extends Controller
{
    function index(){
        return view('admin.manage-users.index');
    }

    function create(Request $request){
      $request->validate([
        'name' =>['required','max:255'],
        'username' =>['required','max:255','unique:users,username'],
        'email' => ['required','email','max:255','unique:users,email,'],
        'password' => ['required','max:255','confirmed'],
        'password_confirmation' => ['required'],
        'role' => ['required','in:vendor,user,admin'],
      ]);

      $password = $request->password;
      $hashedPassword = Hash::make($password);

      $user = new User();
      if($request->role == 'user'){
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $hashedPassword;
        $user->status = 'active';
        $user->role ='user';
        $user->save();
       }elseif($request->role == 'vendor'){
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $hashedPassword;
        $user->status = 'active';
        $user->role ='vendor';
        $user->save();

        $vendor = new Vendor();
        $vendor->banner = 'uploads/1343.jpg';
        $vendor->shop_name =$request->name;
        $vendor->phone = '12321312';
        $vendor->email = $user->email;
        $vendor->address = 'Usa';
        $vendor->description = 'shop description';
        $vendor->user_id = $user->id;
        $vendor->status = 1;
        $vendor->save();
       }elseif($request->role == 'admin'){
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $hashedPassword;
        $user->status = 'active';
        $user->role ='admin';
        $user->save();

        $vendor = new Vendor();
        $vendor->banner = 'uploads/1343.jpg';
        $vendor->shop_name = $request->name;
        $vendor->phone = '12321312';
        $vendor->email = $user->email;
        $vendor->address = 'Usa';
        $vendor->description = 'shop description';
        $vendor->user_id = $user->id;
        $vendor->status = 1;
        $vendor->save();
       }
       Mail::to($request->email)->send(new NewUserMail($user,$password));
       toastr('User Saved Successfully');
       return redirect()->back();
    }


}
