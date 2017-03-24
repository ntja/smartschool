<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\questionsCustom;
use App\Repositories\Custom\Resource\Question as ResourceQuestion;
use Exception;

class QuestionsController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['post']]);
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
            $resource_question = new ResourceQuestion();
            if (Gate::forUser($account)->denies('post', $resource_question)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return $result;
            }
            $course_info = file_get_contents('php://input');
            $data = json_decode($course_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 400, "description" => "invalid request body");
                return response()->json($result, 400);
            }

            //retrieve user inputs
            $title = array_key_exists("title", $data) ? $data["title"] : null;
            $description = array_key_exists("description", $data) ? $data["description"] : null;
			$is_visible = array_key_exists("is_visible", $data) ? $data["is_visible"] : '1';
			
			$instructor = null;
			$learner = null;
			
			$user_role = $account->getPropertyValue('role');
			if($user_role === "INSTRUCTOR"){
				// ID of connected user
				$instructor = $account_token_id;
			}
			if($user_role === "LEARNER"){
				//ID of connected user
				$learner = $account_token_id;
			}
			//$learner = array_key_exists("learner", $data) ? $data["learner"] : null;
			//$instructor = array_key_exists("instructor", $data) ? $data["instructor"] : null;

            $informations = array(
                'title' => $title,
                'description' => $description,
				'is_visible' => $is_visible,
				'learner' => $learner,
				'instructor' => $instructor,
            );
			//var_dump($learner);die();
            $custom_question = new questionsCustom();            
            $result = $custom_question->dbSave($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}