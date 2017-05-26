<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\Custom\Accounts\SocialCustom;
use Exception;
use Gate;

class SocialController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        // Apply the jwt.auth middleware to all methods in this controller
        // except for the authenticate method. We don't want to prevent
        // the user from retrieving their token if they don't already have it
        $this->middleware('jwt.auth', ['except' => ['post']]);
    }

    // GET THE DATA OF THE USER AND  REGISTER IT FOR LOGIN
    public function post(Request $request) {
        try {            
            $user_info = file_get_contents('php://input');
            $data = json_decode($user_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 403, "description" => "invalid request body");
                return response()->json($result,400);
            }                   
            //retrieve user inputs
            $network = array_key_exists("network", $data) ? $data["network"] : null;
            $network_token = array_key_exists("network_token", $data) ? $data["network_token"] : null;            

            $informations = array(
				'network' => $network,
                'network_token' => $network_token,                
            );           
			//var_dump($informations);die();
            $custom_social = new SocialCustom();
           
            $result = $custom_social->db_save($informations);            
            return $result;
        } catch (Exception $e) {
            return response()->json('An Internal error occuredSS', 400);
        }
    }

}
