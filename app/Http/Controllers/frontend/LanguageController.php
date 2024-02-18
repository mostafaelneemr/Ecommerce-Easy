<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function Arabic()
    {
        session()->get('language');
        session()->forget('language');
        session()->put('language', 'arabic');
        return redirect()->back();
    }

    public function English()
    {
        session()->get('language');
        session()->forget('language');
        session()->put('languaue', 'english');
        return redirect()->back();
    }
}
