<?php

namespace App\Http\Controllers\Courses;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Courses\CategoriesCustom;
use App\Repositories\Custom\Resource\Courses\Category as ResourceCategory;
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
            //var_dump($account->getRole());die();
            $ressource_category = new ResourceCategory();
            if (Gate::forUser($account)->denies('post', $ressource_category)) {
                LogRepo::printLog('error', "Invalid attempt to create a course category with the role ".$account->getRole());
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result, 400);
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
            $description = array_key_exists("description", $data) ? $data["description"] : null;            

            $informations = array(
                'name' => $name,                
                'shortname' => $shortname,
                'description' => $description,                
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
}