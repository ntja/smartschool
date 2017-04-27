<?php

namespace App\Http\Controllers\Courses\Course;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Courses\Course\JoinCustom;
use App\Repositories\Custom\Resource\Courses\Course\Join as ResourceJoin;
use Exception;

class JoinController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth');
    }    

    /**
     * create  new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request, $id) {
        try {                      
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            //var_dump($account->getRole());die();
            $resource_join = new ResourceJoin($id);
            if (Gate::forUser($account)->denies('post', [$resource_join,false])) {
                LogRepo::printLog('error', "Invalid attempt to apply to a course with the role ".$account->getRole());
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result, 400);
            }            
            $status = null;
            $requestedby = null;
            $date_requested = null;
            $date_joined = null;
            //var_dump($account->getRole());die();
            if($account->getRole()==="INSTRUCTOR"){
                $course_info = file_get_contents('php://input');
                $data = json_decode($course_info, TRUE);
                if (!is_array($data)) {
                    $result = array("code" => 400, "description" => "invalid request body");
                    return response()->json($result, 400);
                }
                //retrieve user inputs
                $learner_account = array_key_exists("account", $data) ? $data["account"] : null;
                $status = "ACCEPTED";  // if invitation is sent by INSTRUCTOR, the status is accepted
                $requestedby = $account->getRole();
                $date_requested = date("Y-m-d H:m:i");
                $date_joined = date("Y-m-d H:m:i");
            }elseif($account->getRole() ==="LEARNER"){
                $learner_account = $account->getPropertyValue('id');
                $status = "ACCEPTED"; // if invitation is sent by LEARNER, the status is accepted
                $requestedby = $account->getRole();
                $date_requested = date("Y-m-d H:m:i");
                $date_joined = date("Y-m-d H:m:i");
            }
            $informations = array(
                'account' => $learner_account,                
                'status' => $status,
                'course' => $id,
                'requestedby' => $requestedby,
                'date_requested' =>$date_requested,
                'date_joined' => $date_joined,
            );
			//var_dump($informations);die();
            $custom_join = new JoinCustom();
            $result = $custom_join->DbSave($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}