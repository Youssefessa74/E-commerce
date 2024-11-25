<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{

    function index(){
        $wishlistProducts = Wishlist::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('frontend.pages.wishlist',compact('wishlistProducts'));
    }
    function AddToWishlist(Request $request) {
        if (!Auth::check()) {
            return response(['status' => 'error', 'message' => 'Please Sign in to add a product to the wishlist'], 403);
        }

        $wishlistItem = Wishlist::where([
            'product_id' => $request->productId,
            'user_id' => Auth::id()
        ])->first();

        // Check if the product is already in the user's wishlist
        if ($wishlistItem) {
            return response(['status' => 'error', 'message' => 'This product is already in your wishlist'], 403);
        }

        // Add the product to the wishlist
        $wishlist = new Wishlist();
        $wishlist->product_id = $request->productId;
        $wishlist->user_id = Auth::id();
        $wishlist->save();

        $count = Wishlist::where('user_id', Auth::id())->count();

        return response(['status' => 'success', 'message' => 'Product added to the wishlist successfully!', 'count' => $count], 200);
    }

    function destroy($id){
        $wishlistProduct = Wishlist::findOrFail($id);
        if($wishlistProduct->user_id != Auth::user()->id){
            return redirect()->back();
        }else{
            $wishlistProduct->delete();
            toastr('Product Deleted Successfully','success');
            return redirect()->back();
        }
    }

}
