<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\UserCustom;

class AccountController extends Controller {

    public function __construct() {
        
    }

    /*
     * Home page
     */

    public function uploadImage(Request $request) {

        $destinationPath = public_path() . "/uploads/images/";
        if ($request->hasFile('image')) {
            $extention = $request->file('image')->getClientOriginalExtension();
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
            $photo_name = url('/') . "/uploads/images/" . $fileName;
            $result = array("code" => 200, "file_name" => url('/') . "/uploads/images/" . $fileName);
            return response()->json($result, 200);
        } else {
            $result = "file not present";
            return response()->json($result, 400);
        }
    }
    public function home() {
        return view('home');
    }

    /*
     * edit profile action
     */

    public function edit_profile() {
    //if (!(isset($_COOKIE['token']) && isset($_COOKIE['account_id']))) {
    //return redirect('/register');
    //}
        return view('account.edit-profile');
    }

    /*
     * view profile action
     */

    public function view_profile() {
         if (!(isset($_COOKIE['token']) && isset($_COOKIE['account_id']))) {
            return redirect('/register');
        }
        return view('account.view-profile');
    }

    /*
     * logout action
     */

    public function logout() {
        return view('logout');
    }

}
