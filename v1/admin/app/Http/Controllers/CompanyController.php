<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\UserCustom;

class CompanyController extends Controller {

    public function __construct() {
        
    }

    /*
     * create profile action
     */

    public function create() {
         if (!(isset($_COOKIE['token']) && isset($_COOKIE['account_id']))) {
            return redirect('/register');
        }
        return view('company.create');
    }

    /*
     * view profile action
     */

    public function view($id) {
         if (!(isset($_COOKIE['token']) && isset($_COOKIE['account_id']))) {
            return redirect('/register');
        }
        return view('company.view', ['company_id' => $id]);
    }

}
