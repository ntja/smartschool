<?php

namespace App\Http\Controllers\Courses\Lessons;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Courses\Lessons\LessonCustom;
use App\Repositories\Custom\Courses\Course\SectionsCustom;
use App\Repositories\Custom\Resource\Courses\Lessons\Lesson as ResourceLesson;
use Exception;

class LessonController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['get']]);
    }           
	
	public function get(Request $request, $id) {
		try {
			$data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);		
			//var_dump($account);die();
            $ressource_lesson = new ResourceLesson($id);
            if (Gate::forUser($account)->denies('get', [$ressource_lesson])) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request.");
                return response()->json($result,400);
            }
			
			//var_dump($information);die();
            $custom_lesson = new LessonCustom();            
            $result = $custom_lesson->getLesson($id);
            return $result;
		} catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
	}		
}