<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//use App\Models\Account;
use App\Repositories\Custom\Accounts\AccountCustom;
use \App\Repositories\Custom\Resource\Accounts\Social as ResourceSocial;
use App\Repositories\Custom\Accounts\SocialCustom;
use Exception;

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
            $data = $request->only('account_id');			
            $account_token_id = $data['account_id'];
            $account = new AccountCustom($account_token_id);
			//var_dump($account);die();
            $ressource_social = new ResourceSocial();
            if (Gate::forUser($account)->denies('post', $ressource_social)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request.");
                return response()->json($result, 400);
            }
            $user_info = file_get_contents('php://input');
            $data = json_decode($user_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 403, "description" => "invalid request body");
                return response()->json($result,400);
            }
        
            $network = array_key_exists("network", $data) ? $data["network"] : null;
            $network_token = array_key_exists("network_token", $data) ? $data["network_token"] : null;

            $informations = array(               
                'network' => $network,
                'network_token' => $network_token,
            );

            $custom_social = new SocialCustom();
           
            $result = $custom_social->db_save($informations);            
            return $result;
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

}
