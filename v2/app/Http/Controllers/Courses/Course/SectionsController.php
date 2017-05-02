<?php

namespace App\Http\Controllers\Courses\Course;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Courses\Course\SectionsCustom;
use App\Repositories\Custom\Resource\Courses\Course\Section as ResourceSection;
use Exception;

class SectionsController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['get']]);
    }           
	
	public function post(Request $request, $id) {
		try {
			$data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $ressource_section = new ResourceSection();
            if (Gate::forUser($account)->denies('post', [$ressource_section,true])) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request.");
                return response()->json($result,400);
            }
			
			$section_info = file_get_contents('php://input');
            $decode_data = json_decode($section_info, TRUE);
            if (!is_array($decode_data)) {
                $result = array("code" => 400, "description" => "invalid request body");
                return response()->json($result, 400);
            }
			//retrieve user inputs
            $title = array_key_exists("title", $decode_data) ? $decode_data["title"] : null;
            $description = array_key_exists("description", $decode_data) ? $decode_data["description"] : null;
			$is_visible = array_key_exists("is_visible", $decode_data) ? $decode_data["is_visible"] : "0";
			
			$information = array(
                'title' => $title,
                'course' => $id,
				'description' => $description,
				'is_visible' => $is_visible,
            );
			//var_dump($information);die();
            $custom_section = new SectionsCustom();            
            $result = $custom_section->DbSave($information);            
            return response()->json($result);
		} catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
	}
	
	public function get(Request $request, $id) {
        try {                      
            $data = $request->only('account_id','limit','is_visible');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $ressource_section = new ResourceSection();
            if (Gate::forUser($account)->denies('get', $ressource_section)) {
                $result = array("code" => 4003, "description" => "You do not have permissions for that request.");
                return response()->json($result,400);
            }
            
            if(!$data['limit']){
                $limit = 12;
            }else{
                $limit = $data['limit'];
            }         

            $is_visible = $data['is_visible'];            

            $informations = array(
                'limit' => $limit,                
                'is_visible' => $is_visible,
            );
            //var_dump($account->getRole());die();
            $custom_course = new SectionsCustom();            
            $result = $custom_course->getList($informations, $id);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}