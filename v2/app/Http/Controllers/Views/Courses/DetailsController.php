<?php

namespace App\Http\Controllers\Views\Courses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailsController extends Controller {

    public function get(Request $request, $id) {
        return view('courses.details')->with(['course_id' => $id]);
    }
}