<?php

namespace App\Http\Controllers\Accounts\Account;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Accounts\Account\CoursesCustom;
use App\Repositories\Custom\Resource\Accounts\Account\Courses as ResourceCourse;
use Exception;

class CoursesController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth');
    }    

    public function get(Request $request, $id) {
        try {                      
            $data = $request->only('account_id','limit','status');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $ressource_course = new ResourceCourse();
            if (Gate::forUser($account)->denies('get', $ressource_course)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result);
            }
            
            if(!$data['limit']){
                $limit = 10;
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
            $result = $custom_course->getList($informations, $account, $id);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}