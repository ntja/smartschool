<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\answersCustom;
use App\Repositories\Custom\Resource\Answer as ResourceAnswer;
use Exception;

class AnswersController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth');
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
            $resource_answer = new ResourceAnswer();
            if (Gate::forUser($account)->denies('post', $resource_answer)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return $result;
            }
            $course_info = file_get_contents('php://input');
            $data = json_decode($course_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 400, "description" => "invalid request body");
                return response()->json($result, 400);
            }
			
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
			
            //retrieve user inputs
            $question = array_key_exists("question", $data) ? $data["question"] : null;
            $content = array_key_exists("content", $data) ? $data["content"] : null;
			//$score =  0;
			//$learner = array_key_exists("learner", $data) ? $data["learner"] : null;
			//$instructor = array_key_exists("instructor", $data) ? $data["instructor"] : null;

            $informations = array(
                'question' => $question,
                'content' => $content,
				//'score' => $score,
				'learner' => $learner,
				'instructor' => $instructor,
            );
			//var_dump($informations);die();
            $custom_answer = new answersCustom();            
            $result = $custom_answer->dbSave($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}