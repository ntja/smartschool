<?php

namespace App\Http\Controllers\Books;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Books\CategoriesCustom;
use App\Repositories\Custom\Resource\Books\Category as ResourceCategory;
use Exception;

class CategoriesController extends Controller {

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
            $ressource_category = new ResourceCategory();
            if (Gate::forUser($account)->denies('post', $ressource_category)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result);
            }
            $course_info = file_get_contents('php://input');
            $data = json_decode($course_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 400, "description" => "invalid request body");
                return response()->json($result, 400);
            }

            //retrieve inputs
            $name = array_key_exists("name", $data) ? $data["name"] : null;            

            $informations = array(
                'name' => $name,                
            );
			//var_dump($informations);die();
            $custom_category = new CategoriesCustom();            
            $result = $custom_category->dbSave($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }

    public function get(Request $request) {
        try {                      
            $data = $request->only('account_id','limit');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $ressource_category = new ResourceCategory();
            if (Gate::forUser($account)->denies('get', $ressource_category)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result);
            }
            
            if(!$data['limit']){
                $limit = 12;
            }else{
                $limit = $data['limit'];
            }         

            $informations = array(
                'limit' => $limit,                
            );
            //var_dump($account->getRole());die();
            $custom_category = new CategoriesCustom();
            $result = $custom_category->getList($informations,$account);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}