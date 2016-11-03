<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\CitiesCustom;
use App\Repositories\Custom\Resource\City as ResourceCity;
use Exception;

class CitiesController extends Controller {

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
            $ressource_city = new ResourceCity();
            if (Gate::forUser($account)->denies('post', $ressource_city)) {
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
            $name = array_key_exists("name", $data) ? $data["name"] : null;
            $country = array_key_exists("country", $data) ? $data["country"] : null;            

            $informations = array(
                'name' => $name,
                'country' => $country,                
            );
			//var_dump($informations);die();
            $custom_city = new CitiesCustom();            
            $result = $custom_city->dbSave($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}