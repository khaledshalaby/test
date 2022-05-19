<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    //
    public function index(Request $request,$locale) {
        //set’s application’s locale
        app()->setLocale($locale);
        return redirect()->back();
     }
}
