<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLogin;
use App\Http\Requests\Admin\ChangePassowrdRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\User;
use App\Traits\upload_file;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use upload_file;
    function dashboard()
    {
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $todayPendingOrders = Order::whereDate('created_at', Carbon::today())->where('order_status', 'pending')->count();
        $totalOrders = Order::count();
        $totalPendingOrders = Order::where('order_status', 'pending')->count();
        $totalCompeleteOrders = Order::where('order_status', 'pending')->count();
        $todayEarnings = Order::whereDate('created_at', Carbon::today())->where('order_status', '!=', 'canceled')->sum('sub_total');
        $thisMonthEarnings = Order::whereDate('created_at', Carbon::now()->month)->where('order_status', '!=', 'canceled')->sum('sub_total');
        $thisYearEarnings = Order::whereDate('created_at', Carbon::now()->year)->where('order_status', '!=', 'canceled')->sum('sub_total');
        $totalReviews = ProductReview::count();
        $totalReview = ProductReview::count();
        $totalBrands = Brand::count();
        $totalCategories = Category::count();
        $totalBlogs = Blog::count();
        $totalSubscriber = NewsletterSubscriber::count();
        $totalVendors = User::where('role', 'vendor')->count();
        $totalUsers = User::where('role', 'user')->count();
        return view('admin.home.main', compact(
            'todayOrders',
            'todayPendingOrders',
            'totalOrders',
            'totalPendingOrders',
            'totalCompeleteOrders',
            'todayEarnings',
            'thisMonthEarnings',
            'thisYearEarnings',
            'totalReviews',
            'totalBrands',
            'totalCategories',
            'totalBlogs',
            'totalSubscriber',
            'totalVendors',
            'totalUsers'
        ));
    }

    function AdminLogin()
    {
        return view('auth.admin-login');
    }

    public function store(AdminLogin $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user()->role == 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->back()->withInput();
    }

    function profile()
    {
        return view('admin.profile.index');
    }

    function ProfileUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email,' . $request->id],
            'image' => ['image', 'max:2048'],
        ]);

        $user = User::findOrFail($request->id);

        // Handle image upload
        $image = $this->uploadFile($request, 'image', $user->image);

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;

        // If there’s a new image, use it; otherwise, keep the old one
        $user->image = $image ?: $user->image;

        $user->save();

        toastr('Data has been Updated Successfully', 'success');
        return redirect()->back();
    }

    public function ProfileUpdatePassword(ChangePassowrdRequest $request)
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Optionally, you can redirect with a success message
        toastr('Password updated successfully', 'success');
        return redirect()->back();
    }
}
