<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UserUpdatePassword;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\User;
use App\Models\Wishlist;
use App\Traits\upload_file;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    use upload_file;
    function index()
    {
        $totalOrders = Order::where('user_id',auth()->user()->id)->count();
        $pendingOrders = Order::where('user_id',auth()->user()->id)->where('order_status','pending')->count();
        $compeleteOrders = Order::where('user_id',auth()->user()->id)->where('order_status','delivered')->count();

        $totalReviews = ProductReview::where('user_id',auth()->user()->id)->count();
        $totalWishlists = Wishlist::where('user_id',auth()->user()->id)->count();
        return view('frontend.dashboard.dashboard',compact('totalOrders','totalReviews','totalWishlists','pendingOrders','compeleteOrders'));
    }

    function MyProfile()
    {
        return view('frontend.dashboard.sections.myprofile');
    }

    function UpdateUserProfile(Request $request)
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

    function UpdateUserPassword(UserUpdatePassword $request){
        $user = User::findOrFail($request->id);
        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Optionally, you can redirect with a success message
        toastr('Password updated successfully', 'success');
        return redirect()->back();
    }

    function UserReviews(){
        $reviews = ProductReview::where('user_id',auth()->user()->id)->paginate(10);
        return view('frontend.dashboard.sections.reviews',compact('reviews'));
    }
}
