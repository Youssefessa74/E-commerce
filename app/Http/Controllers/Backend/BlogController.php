<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Traits\upload_file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    use upload_file;
    /**
     * Display a listing of the resource.
     */
    public function index(BlogDataTable $blogDataTable)
    {
        return $blogDataTable->render('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogCategory = BlogCategory::all();
        return view('admin.blog.create',compact('blogCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required','exists:blog_categories,id'],
            'image' => ['required','image','max:1000'],
            'title' => ['required','max:255','unique:blogs,title'],
            'description' => ['max:1000'],
            'seo_title' => ['nullable','max:255'],
            'seo_description' => ['nullable','max:1000'],
            'status' => ['required','boolean'],
        ]);
        $Image = $this->uploadFile($request,'image');
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->category_id = $request->category;
        $blog->description = $request->description;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->status;
        $blog->image = $Image;
        $blog->slug =Str::slug($request->title);
        $blog->user_id = Auth::user()->id;
        $blog->save();
        toastr('Data Saved Successfully');
        return to_route('admin.blogs.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blogCategory = BlogCategory::all();
        $blogs = Blog::findOrFail($id);
        return view('admin.blog.edit',compact('blogs','blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => ['required','exists:blog_categories,id'],
            'image' => ['image','max:1000'],
            'title' => ['required','max:255','unique:blogs,title,'.$id],
            'description' => ['max:1000'],
            'seo_title' => ['nullable','max:255'],
            'seo_description' => ['nullable','max:1000'],
            'status' => ['required','boolean'],
        ]);
        $Image = $this->uploadFile($request,'image','old_image');
        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->category_id = $request->category;
        $blog->description = $request->description;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->status;
        $blog->image = isset($Image) ? $Image : $request->old_image;
        $blog->slug =Str::slug($request->title);
        $blog->user_id = Auth::user()->id;
        $blog->save();
        toastr('Data Saved Successfully');
        return to_route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $this->removeFile($blog->image);
        $blog->comments()->delete();
        $blog->delete()
;        toastr('Data Saved Successfully');
        return to_route('admin.blogs.index');
    }

    function ChangeStatus(Request $request) {
        $request->validate([
            'status' => ['required'],
        ]);
        $blog = Blog::findOrFail($request->id);
        $blog->status = !$request->status ;
        $blog->save();
        return response(['status' => 'success'],200);

    }

   

}
