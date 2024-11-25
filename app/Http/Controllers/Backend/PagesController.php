<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    function about(){
        $content = About::first();
        return view('admin.about.index',compact('content'));
      }

      function updateAbout(Request $request){
        $request->validate([
            'content' =>['required'],
        ]);
        About::updateOrCreate(
            ['id' => 1],
            ['content' => $request->content],
        );

        toastr('Condition Saved Successfully');
        return redirect()->back();
      }

      function TermsAndConditions(){
        $content = TermsAndCondition::first();
        return view('admin.terms-conditions.index',compact('content'));
      }

      function TermsAndConditionsUpdate(Request $request){
        $request->validate([
            'content' =>['required'],
        ]);
        TermsAndCondition::updateOrCreate(
            ['id' => 1],
            ['content' => $request->content],
        );

        toastr('Condition Saved Successfully');
        return redirect()->back();
      }
}
