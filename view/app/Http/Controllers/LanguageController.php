<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LanguageController extends Controller{
    public function switchLang($lang){
		if (array_key_exists($lang, \Config::get('languages'))) {
			\Session::set('applocale', $lang);
		}
		return \Redirect::back();
		}
}
