<?php

namespace App\Http\Controllers\Views\Courses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OverviewController extends Controller {

    public function get(Request $request, $id) {
        return view('courses.overview')->with(['course_id' => $id]);
    }
}