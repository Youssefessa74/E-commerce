<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use App\Traits\upload_file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FooterInfoController extends Controller
{
    use upload_file;
    public function index()
    {
        $footerInfo = FooterInfo::first();
        return view('admin.footer.footer-info',compact('footerInfo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => ['nullable', 'image', 'max:3000'],
            'phone' => ['max:100'],
            'email' => ['max:100'],
            'address' => ['max:300'],
            'copyright' => ['max:100']
        ]);
        $footerInfo = FooterInfo::find($id);
        $image = $this->uploadFile($request, 'logo', $footerInfo?->logo);
        FooterInfo::updateOrCreate(
            ['id' => 1],
            [
                'logo' => isset($image) ? $image :$footerInfo->logo ,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'copyright' => $request->copyright,
            ]
        );
        Cache::forget('footerInfo');
        toastr('Data Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
