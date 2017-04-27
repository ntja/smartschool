<?php

namespace App\Http\Controllers\Localization;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller{
	
	//method allowing us to switch between available language
    public function switchLang($lang){
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('sm_applocale', $lang);
        }
        return Redirect::back();
    }
}
