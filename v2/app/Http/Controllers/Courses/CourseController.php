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
            $resource_course = new ResourceCourse();
            if (Gate::forUser($account)->denies('get', $resource_course)) {
                LogRepo::printLog('error', "Invalid attempt to rerieve course #".$id." by user ".var_export($account,true));
                $result = array("code" => 403, "description" => "You do not have permissions for that request.");
                return response()->json($result, 400);
            }            
			//var_dump($informations);die();
            $custom_course = new CourseCustom();    
			$result = $custom_course->getCourse($id);
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

	public function put(Request $request, $id) {
        try {    
            //retrieving current user ID based on its token
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            //var_export($data);die();
            $current_account = new AccountsCustom(intval($account_token_id)); // account of the user requesting the resource                     
            //checking user permission,
            $resource_course = new ResourceCourse((int)$id);
            //var_export($resource_informations);die();
            if (Gate::forUser($current_account)->denies('put', [$resource_course,true])) {
                LogRepo::printLog('info', "Invalid attempt to update informations of course #{" .$id. "}. Returned code: 4007.");
                $result = array("code" => 4007, "description" => "You do not have permissions for that request..");
                return response()->json($result,400);
            }
			$json_data = file_get_contents('php://input');
            $decode_data = json_decode($json_data, TRUE);  
			//var_dump($decode_data);die();
            if(!is_array($decode_data)){
                $result = array("code" => 4000, "description" => "invalid request body");
                return response()->json($result,400);
            }            
            $entries = array_key_exists("entries", $decode_data)?$decode_data['entries']:null;
            if(!is_array($entries)){
                $result = array("code" => 4000, "description" => "invalid request body");
                return response()->json($result,400);
            }           
            
            for($i=0; $i<count($entries);$i++){
                $info[$entries[$i]['field']] = $entries[$i]['value'];
            }
			
			//var_dump($info);die();
			$custom_course = new CourseCustom(); 
			return $custom_course->updateCourse($info, $id);                               
        } catch (Exception $e) {
            LogRepo::printLog('error', $e->getMessage());
        }
    }

}