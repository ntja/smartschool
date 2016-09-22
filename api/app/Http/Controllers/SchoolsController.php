<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\SchoolsCustom;
use App\Repositories\Custom\Resource\School as ResourceSchool;
use Exception;

class SchoolsController extends Controller {

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
            $ressource_school = new ResourceSchool();
            if (Gate::forUser($account)->denies('post', $ressource_school)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return $result;
            }
            $school_info = file_get_contents('php://input');
            $data = json_decode($school_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 400, "description" => "invalid request body");
                return response()->json($result, 400);
            }

            //retrieve user inputs
            $name = array_key_exists("name", $data) ? $data["name"] : null;
            $shortname = array_key_exists("shortname", $data) ? $data["shortname"] : null;
            $logo = array_key_exists("logo", $data) ? $data["logo"] : null;
            $address = array_key_exists("address", $data) ? $data["address"] : null;			
			$description = array_key_exists("description", $data) ? $data["description"] : null;
			$banner = array_key_exists("banner", $data) ? $data["banner"] : null;
            $homelink = array_key_exists("homelink", $data) ? $data["homelink"] : null;
            $location   = array_key_exists("location", $data) ? $data["location"] : null;
            $location_city   = array_key_exists("location_city", $data) ? $data["location_city"] : null;
            $location_country   = array_key_exists("location_country", $data) ? $data["location_country"] : null;
            $location_lon   = array_key_exists("location_lon", $data) ? $data["location_lon"] : null;
            $location_lat   = array_key_exists("location_lat", $data) ? $data["location_lat"] : null;
            $webtwitter   = array_key_exists("webtwitter", $data) ? $data["webtwitter"] : null;
            $website   = array_key_exists("website", $data) ? $data["website"] : null;
            $webfacebook   = array_key_exists("webfacebook", $data) ? $data["webfacebook"] : null;
            $webyoutube   = array_key_exists("webyoutube", $data) ? $data["webyoutube"] : null;
            $pagebanner   = array_key_exists("pagebanner", $data) ? $data["pagebanner"] : null;            

            $informations = array(
                'name' => $name,
                'shortname' => $shortname,
                'logo' => $logo,
				'address' => $address,
                'description' => $description, 
				'banner' => $banner,
				'homelink' => $homelink,
                'location' => $location,
                'location_city' => $location_city,
                'location_country' => $location_country,
                'location_lon' => $location_lon,
                'location_lat' => $location_lat,
                'website' => $website,
                'webtwitter' => $webtwitter,
                'webfacebook' => $webfacebook,
                'webyoutube' => $webyoutube,
                'pagebanner' => $pagebanner,                
            );
			//var_dump($informations);die();
            $custom_school = new SchoolsCustom();            
            $result = $custom_school->dbSave($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}