<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\CountriesCustom;
use App\Repositories\Custom\Resource\Country as ResourceCountry;
use Exception;

class CountriesController extends Controller {

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
            $ressource_country = new ResourceCountry();
            if (Gate::forUser($account)->denies('post', $ressource_country)) {
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
            $shortname = array_key_exists("shortname", $data) ? $data["shortname"] : null;
            $is_active = array_key_exists("is_active", $data) ? $data["is_active"] : '0';

            $informations = array(
                'name' => $name,
                'shortname' => $shortname,
                'is_active' => $is_active,                
            );
			//var_dump($informations);die();
            $custom_country = new CountriesCustom();            
            $result = $custom_country->dbSave($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}