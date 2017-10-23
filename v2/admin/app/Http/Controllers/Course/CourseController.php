<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller {

    public function edit(Request $request, $id) {
        return view('courses.edit')->with(['course_id' => $id]);
    }
}