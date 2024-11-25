<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    function blogs(Request $request)
    {
        $blogs = Blog::where('status', 1);

        if ($request->has('search')) {
            $blogs->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category')) {
            $category = BlogCategory::where('slug', $request->category)->first();
            $blogs = Blog::where('category_id', $category->id);
        }

        $blogs = $blogs->with(['comments','user','category'])->orderBy('id', 'DESC')->paginate(12); // Assign result of paginate back to $blogs
        return view('frontend.pages.blogs', compact('blogs'));
    }

    public function Suggestions(Request $request)
    {
        $search = $request->get('query');
        $suggestions = Blog::where('status', 1)
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
            })
            ->select('title')
            ->limit(10)
            ->get()
            ->pluck('title'); // Return only titles

        return response()->json($suggestions);
    }


    function index($slug)
    {
        $categories = BlogCategory::where('status', 1)->get();
        $blog = Blog::where('slug', $slug)->where('status', 1)->firstOrFail();
        $moreBlogs = Blog::where('slug', '!=', $slug)->where('category_id', $blog->category_id)->where('status', 1)->take(10)->get();
        $blogComments = BlogComment::where('blog_id', $blog->id)->paginate(2);
        $recentBlogs = Blog::latest()->take(5)->get();
        return view('frontend.pages.blog-details', compact('blog', 'categories', 'moreBlogs', 'blogComments','recentBlogs'));
    }

    function BlogComment(Request $request)
    {
        $request->validate([
            'comment' => ['required', 'max:1500'],
            'user_id' => ['required', 'exists:users,id'],
            'blog_id' => ['required', 'exists:blogs,id'],
        ]);

        $comment = new BlogComment();
        $comment->user_id = $request->user_id;
        $comment->blog_id = $request->blog_id;
        $comment->comment = $request->comment;
        $comment->save();
        toastr('Your Comment Published Successfully');
        return redirect()->back();
    }
}
