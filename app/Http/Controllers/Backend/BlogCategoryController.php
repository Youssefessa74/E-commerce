<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogCategoryDataTable $blogCategoryDataTable)
    {
        return $blogCategoryDataTable->render('admin.blog.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:200','unique:blog_categories,name'],
            'status' => ['required','boolean']
        ]);
        $blogCategory = new BlogCategory();
        $blogCategory->name = $request->name;
        $blogCategory->slug = Str::slug($request->name);
        $blogCategory->status = $request->status;
        $blogCategory->save();
        toastr('Data Saved Successfully');
        return redirect()->route('admin.blog-category.index');
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
      $blogCategory = BlogCategory::findOrFail($id);
      return view('admin.blog.category.edit',compact('blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required','max:200','unique:blog_categories,name,'.$id],
            'status' => ['required','boolean']
        ]);
        $blogCategory = BlogCategory::findOrFail($id);
        $blogCategory->name = $request->name;
        $blogCategory->slug = Str::slug($request->name);
        $blogCategory->status = $request->status;
        $blogCategory->save();
        toastr('Data Saved Successfully');
        return redirect()->route('admin.blog-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blogCategory = BlogCategory::findOrFail($id)->delete();
        toastr('Data Saved Successfully');
        return redirect()->route('admin.blog-category.index');
    }
}
