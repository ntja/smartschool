<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller{

    public function login() {        
        return view('user.login');
    }

    public function register() {        
        return view('user.register');
    }
}
