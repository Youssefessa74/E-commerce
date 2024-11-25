<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FooterSocialDataTable;
use App\Http\Controllers\Controller;
use App\Models\FooterSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterSocialDataTable $footerSocialDataTable)
    {
        return $footerSocialDataTable->render('admin.footer.footer-socials.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-socials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' =>['required','max:200'],
            'name' =>['required','max:200'],
            'url'=>['required'],
            'status'=>['required'],
        ]);
        $footer = new FooterSocial();
        $footer->icon = $request->icon;
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();
        Cache::forget('footerSocials');
        toastr('Data Saved Successfully');
        return to_route('admin.footer-socials.index');

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
        $footer = FooterSocial::find($id);
        return view('admin.footer.footer-socials.edit',compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' =>['required','max:200'],
            'name' =>['required','max:200'],
            'url'=>['required'],
            'status'=>['required'],
        ]);
        $footer =  FooterSocial::findOrFail($id);
        $footer->icon = $request->icon;
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();
        toastr('Data Saved Successfully');
        return to_route('admin.footer-socials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer =  FooterSocial::findOrFail($id);
        $footer->delete();
        toastr('Data Deleted Successfully');
        return to_route('admin.footer-socials.index');
    }

    function FooterChangeStatus(Request $request) {
        $request->validate([
            'status' => ['required','boolean'],
        ]);
        $category = FooterSocial::findOrFail($request->id);
        $category->status = !$request->status ;
        $category->save();
        return response(['status' => 'success'],200);

    }
}
