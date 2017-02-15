<?php

namespace App\Http\Controllers\Courses;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\CoursesCustom;
use App\Repositories\Custom\courses\CourseCustom;
use App\Repositories\Custom\Resource\Courses\Course as ResourceCourse;
use Exception;

class CourseController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['get']]);
    }    

    /**
     * create  new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, $id) {
        try {                      
            //var_dump(is_numeric($id));die();
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            //var_dump($account->getRole());die();
            $ressource_course = new ResourceCourse();
            if (Gate::forUser($account)->denies('get', $ressource_course)) {
                LogRepo::printLog('error', "Invalid attempt to rerieve course #".$id." by user ".var_export($account,true));
                $result = array("code" => 403, "description" => "You do not have permissions for that request.");
                return response()->json($result, 400);
            }            
			//var_dump($informations);die();
            $custom_courses = new CourseCustom();    
			$result = $custom_courses->getcourse($id);
			/*
            if(is_numeric($id)){
                $result = $custom_courses->getcourse($id);
            }else{
                $result = $custom_courses->getCourseByShortname($id);
            }
			*/
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}