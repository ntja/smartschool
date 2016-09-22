<?php

namespace App\Http\Controllers\Learners;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{

    public function get() {        
        return view('learners.dashboard');
    }
}
