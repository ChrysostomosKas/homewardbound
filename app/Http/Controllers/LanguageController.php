<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
class LanguageController extends Controller
{
    public function switchLang($locale)
    {
        if (array_key_exists($locale, Config::get('languages'))) {
            Session::put('applocale', $locale);
        }
        return Redirect::back();
    }
}
