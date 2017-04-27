<?php

namespace App\Http\Controllers\Courses\Course\Sections;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Courses\Course\Sections\LessonsCustom;
use App\Repositories\Custom\Courses\Course\SectionsCustom;
use App\Repositories\Custom\Resource\Courses\Course\Sections\Lesson as ResourceLesson;
use Exception;

class LessonsController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth');
    }           
	
	public function post(Request $request, $id) {
		try {
			$data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
			$section = new SectionsCustom();
			$course_id = $section->getSectionByID($id)->course;
            $ressource_lesson = new ResourceLesson($course_id);
            if (Gate::forUser($account)->denies('post', [$ressource_lesson,true])) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request.");
                return response()->json($result,400);
            }
			
			$lesson_info = file_get_contents('php://input');
            $decode_data = json_decode($lesson_info, TRUE);
            if (!is_array($decode_data)) {
                $result = array("code" => 400, "description" => "invalid request body");
                return response()->json($result, 400);
            }
			//retrieve user inputs
            $title = array_key_exists("title", $decode_data) ? $decode_data["title"] : null;
            $content = array_key_exists("content", $decode_data) ? $decode_data["content"] : null;
			$objective = array_key_exists("objective", $decode_data) ? $decode_data["objective"] : null;
			
			$information = array(
                'title' => $title,
                'section' => $id,
				'content' => $content,
				'objective' => $objective,
            );
			//var_dump($information);die();
            $custom_section = new LessonsCustom();            
            $result = $custom_section->DbSave($information);            
            return response()->json($result);
		} catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
	}		
}