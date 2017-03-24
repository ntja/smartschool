<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\CoursesCustom;
use App\Repositories\Custom\Resource\Course as ResourceCourse;
use Exception;

class CoursesController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['get']]);
    }    

    /**
     * create  new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request) {
        try {                      
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $ressource_course = new ResourceCourse();
            if (Gate::forUser($account)->denies('post', $ressource_course)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result);
            }
            $course_info = file_get_contents('php://input');
            $data = json_decode($course_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 400, "description" => "invalid request body");
                return response()->json($result, 400);
            }

            //retrieve user inputs
            $name = array_key_exists("name", $data) ? $data["name"] : null;
            $shortname = array_key_exists("shortname", $data) ? $data["shortname"] : null;
            $language = array_key_exists("language", $data) ? $data["language"] : null;
            $largeicon = array_key_exists("largeicon", $data) ? $data["largeicon"] : null;			
			$previewlink = array_key_exists("previewlink", $data) ? $data["previewlink"] : null;
			$shortdescription = array_key_exists("shortdescription", $data) ? $data["shortdescription"] : null;
            $start_date = array_key_exists("start_date", $data) ? $data["start_date"] : null;
            $photo = array_key_exists("photo", $data) ? $data["photo"] : null;
            $smallicon   = array_key_exists("smallicon", $data) ? $data["smallicon"] : null;
            $smalliconhover   = array_key_exists("smalliconhover", $data) ? $data["smalliconhover"] : null;
            $istranslate   = array_key_exists("istranslate", $data) ? $data["istranslate"] : '0';
            $directorypath   = array_key_exists("directorypath", $data) ? $data["directorypath"] : null;
            $aboutthecourse   = array_key_exists("aboutthecourse", $data) ? $data["aboutthecourse"] : null;
            $targetaudience   = array_key_exists("targetaudience", $data) ? $data["targetaudience"] : '0';
            $faq   = array_key_exists("faq", $data) ? $data["faq"] : null;
            $coursesyllabus   = array_key_exists("coursesyllabus", $data) ? $data["coursesyllabus"] : null;
            $courseformat   = array_key_exists("courseformat", $data) ? $data["courseformat"] : null;
            $suggestedreadings   = array_key_exists("suggestedreadings", $data) ? $data["suggestedreadings"] : null;
            $estimatedclassworkload   = array_key_exists("estimatedclassworkload", $data) ? $data["estimatedclassworkload"] : null;
            $suggestedreadings   = array_key_exists("suggestedreadings", $data) ? $data["suggestedreadings"] : null;
            $recommendedbackground   = array_key_exists("recommendedbackground", $data) ? $data["recommendedbackground"] : null;
            //$instructor   = array_key_exists("instructor", $data) ? $data["instructor"] : null;
            $instructor = $account_token_id;
            $school   = array_key_exists("school", $data) ? $data["school"] : null;
            $category   = array_key_exists("category", $data) ? $data["category"] : null;


            $informations = array(
                'name' => $name,
                'shortname' => $shortname,
                'language' => $language,
				'photo' => $photo,
                'largeicon' => $largeicon, 
				'previewlink' => $previewlink,
				'shortdescription' => $shortdescription,
                'start_date' => $start_date,
                'smallicon' => $smallicon,
                'smalliconhover' => $smalliconhover,
                'istranslate' => $istranslate,
                'directorypath' => $directorypath,
                'aboutthecourse' => $aboutthecourse,
                'targetaudience' => $targetaudience,
                'faq' => $faq,
                'coursesyllabus' => $coursesyllabus,
                'courseformat' => $courseformat,
                'suggestedreadings' => $suggestedreadings,
                'estimatedclassworkload' => $estimatedclassworkload,
                'recommendedbackground' => $recommendedbackground,
                'instructor' => $instructor,
                'school' => $school,
                'category' => $category,
            );
			//var_dump($informations);die();
            $custom_course = new CoursesCustom();            
            $result = $custom_course->dbSave($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }

    public function get(Request $request) {
        try {                      
            $data = $request->only('account_id','limit','status');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $ressource_course = new ResourceCourse();
            if (Gate::forUser($account)->denies('get', $ressource_course)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request.");
                return response()->json($result,400);
            }
            
            if(!$data['limit']){
                $limit = 12;
            }else{
                $limit = $data['limit'];
            }         

            $status = $data['status'];            

            $informations = array(
                'limit' => $limit,                
                'status' => $status,
            );
            //var_dump($account->getRole());die();
            $custom_course = new CoursesCustom();            
            $result = $custom_course->getList($informations,$account);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}