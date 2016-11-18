<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function(){
	return view('dashboard.dashboard');
});

Route::get('/login', function(){
	return view('login.login');
});


Route::get('/users', function(){
	return view('users.list');
});

Route::get('/users/{id}', function(){
	return view('users.details');
})->where('id', '[0-9]+');

Route::get('/users/{id}/edit', function(){
	return view('users.edit');
})->where('id', '[0-9]+');

Route::get('/courses', function(){
	return view('courses.list');
});

Route::get('/companies/{id}/jobs', function(){
	return view('companies.jobs.list');
})->where('id', '[0-9]+');

Route::get('/companies/{idCompany}', function(){
	return view('companies.details');
})->where('idCompany', '[0-9]+');

Route::get('/users/{idUser}', function(){
	return view('users.details');
})->where('idUser', '[0-9]+');

Route::get('/dashboard', function(){
	return view('dashboard.dashboard');
});

Route::get('/reset-password', function(){
	return view('password.reset');
});

// Skills routes
Route::get('/settings/skills', function(){
	return view('settings.skills.skills');
});

Route::get('/settings/skills/add', function(){
	return view('settings.skills.add');
});

Route::get('/settings/skills/{Id}', function(){
	return view('settings.skills.item');
})->where('Id', '[0-9]+');

// End skills routes



// Jobs title routes
Route::get('/settings/job-titles', function(){
	return view('settings.jobtitles.list');
});

Route::get('/settings/job-titles/add', function(){
	return view('settings.jobtitles.add');
});

Route::get('/settings/job-titles/{Id}', function(){
	return view('settings.jobtitles.item');
})->where('Id', '[0-9]+');

// End jobs titles routes


// Institution names routes
Route::get('/settings/institution-names', function(){
	return view('settings.institutionnames.list');
});

Route::get('/settings/institution-names/add', function(){
	return view('settings.institutionnames.add');
});

Route::get('/settings/institution-names/{Id}', function(){
	return view('settings.institutionnames.item');
})->where('Id', '[0-9]+');

// End jobs titles routes


// Industry routes
Route::get('/settings/industry', function(){
	return view('settings.industry.list');
});

Route::get('/settings/industry/add', function(){
	return view('settings.industry.add');
});

Route::get('/settings/industry/{Id}', function(){
	return view('settings.industry.item');
})->where('Id', '[0-9]+');

// End industry routes


// Honors routes
Route::get('/settings/honors', function(){
	return view('settings.honors.list');
});

Route::get('/settings/honors/add', function(){
	return view('settings.honors.add');
});

Route::get('/settings/honors/{Id}', function(){
	return view('settings.honors.item');
})->where('Id', '[0-9]+');

// End honors routes


// Honors routes
Route::get('/settings/job-types', function(){
	return view('settings.jobtypes.list');
});

Route::get('/settings/job-types/add', function(){
	return view('settings.jobtypes.add');
});

Route::get('/settings/job-types/{Id}', function(){
	return view('settings.jobtypes.item');
})->where('Id', '[0-9]+');

// End honors routes


// Company-names routes
Route::get('/settings/company-names', function(){
	return view('settings.companynames.list');
});

Route::get('/settings/company-names/add', function(){
	return view('settings.companynames.add');
});

Route::get('/settings/company-names/{Id}', function(){
	return view('settings.companynames.item');
})->where('Id', '[0-9]+');

// End company-names routes



// education-degrees routes
Route::get('/settings/education-degrees', function(){
	return view('settings.educationdegrees.list');
});

Route::get('/settings/education-degrees/add', function(){
	return view('settings.educationdegrees.add');
});

Route::get('/settings/education-degrees/{Id}', function(){
	return view('settings.educationdegrees.item');
})->where('Id', '[0-9]+');

// End education-degrees routes


// course-names routes
Route::get('/settings/course-names', function(){
	return view('settings.coursenames.list');
});

Route::get('/settings/course-names/add', function(){
	return view('settings.coursenames.add');
});

Route::get('/settings/course-names/{Id}', function(){
	return view('settings.coursenames.item');
})->where('Id', '[0-9]+');

// End course-names routes



// education majors routes
Route::get('/settings/education-majors', function(){
	return view('settings.educationmajors.list');
});

Route::get('/settings/education-majors/add', function(){
	return view('settings.educationmajors.add');
});

Route::get('/settings/education-majors/{Id}', function(){
	return view('settings.educationmajors.item');
})->where('Id', '[0-9]+');

// End education majors routes


// education minors routes
Route::get('/settings/education-minors', function(){
	return view('settings.educationminors.list');
});

Route::get('/settings/education-minors/add', function(){
	return view('settings.educationminors.add');
});

Route::get('/settings/education-minors/{Id}', function(){
	return view('settings.educationminors.item');
})->where('Id', '[0-9]+');

// End education minors routes


// courses fields routes
Route::get('/settings/course-fields', function(){
	return view('settings.coursefields.list');
});

Route::get('/settings/course-fields/add', function(){
	return view('settings.coursefields.add');
});

Route::get('/settings/course-fields/{Id}', function(){
	return view('settings.coursefields.item');
})->where('Id', '[0-9]+');

// End courses fields routes


// certification titles routes
Route::get('/settings/certification-titles', function(){
	return view('settings.certificationtitles.list');
});

Route::get('/settings/certification-titles/add', function(){
	return view('settings.certificationtitles.add');
});

Route::get('/settings/certification-titles/{Id}', function(){
	return view('settings.certificationtitles.item');
})->where('Id', '[0-9]+');

// End certification titles routes


// languages routes
Route::get('/settings/languages', function(){
	return view('settings.languages.list');
});

Route::get('/settings/languages/add', function(){
	return view('settings.languages.add');
});

Route::get('/settings/languages/{Id}', function(){
	return view('settings.languages.item');
})->where('Id', '[0-9]+');

// End languages routes

Route::get('/jobs', function(){
	return view('jobs.list');
});

// status routes
Route::get('/settings/current-status', function(){
	return view('settings.currentstatus.list');
});

Route::get('/settings/current-status/add', function(){
	return view('settings.currentstatus.add');
});

Route::get('/settings/current-status/{Id}', function(){
	return view('settings.currentstatus.item');
})->where('Id', '[0-9]+');

// End status routes

// licenses routes
Route::get('/settings/licenses', function(){
	return view('settings.licenses.list');
});
/**/
Route::get('/settings/licenses/add', function(){
	return view('settings.licenses.add');
});

Route::get('/settings/licenses/{Id}', function(){
	return view('settings.licenses.item');
})->where('Id', '[0-9]+');

// End licenses routes

// security-clearances routes
Route::get('/settings/security-clearances', function(){
	return view('settings.securityclearances.list');
});
/**/
Route::get('/settings/security-clearances/add', function(){
	return view('settings.securityclearances.add');
});

Route::get('/settings/security-clearances/{Id}', function(){
	return view('settings.securityclearances.item');
})->where('Id', '[0-9]+');

// End security-clearances routes

// file upload
Route::post('fileupload', 'AccountController@uploadImage');
/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

Route::group(['middleware' => ['web']], function () {
    //
    /*
     *  Route to go to Home Page
     */
    Route::get('index', 'UserController@home');
});
Route::get('welcome/{locale?}', function ($locale = null) {
    App::setLocale($locale);
    return redirect('cats');
});
