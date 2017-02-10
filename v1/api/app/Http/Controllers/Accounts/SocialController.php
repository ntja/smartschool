<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

//use App\Models\Account;
use App\Repositories\Custom\AccountsCustom;
use \App\Repositories\Custom\Resource\Accounts\Social as ResourceSocial;
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
            $data = $request->only('account_id','network');			
            $account_token_id = $data['account_id'];
			$network = $data["network"];
            $account = new AccountsCustom($account_token_id);
			//var_dump($data);die();
            $resource_social = new ResourceSocial();
            if (Gate::forUser($account)->denies('post', $resource_social)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request.");
                return response()->json($result, 400);
            }
            $user_info = file_get_contents('php://input');
            $data = json_decode($user_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 403, "description" => "invalid request body");
                return response()->json($result,400);
            }                   
            //retrieve user inputs
            $email = array_key_exists("email", $data) ? $data["email"] : null;
            $first_name = array_key_exists("first_name", $data) ? $data["first_name"] : null;
            $last_name = array_key_exists("last_name", $data) ? $data["last_name"] : null;
            $role = array_key_exists("role", $data) ? $data["role"] : null;
			$honorific = array_key_exists("honorific", $data) ? $data["honorific"] : "Mr";
			$phone = array_key_exists("phone", $data) ? $data["phone"] : null;
			$photo = array_key_exists("photo", $data) ? $data["photo"] : null;
            $password = array_key_exists("password", $data) ? $data["password"] : null;			

            $informations = array(
                'email' => $email,
				'network' => $network,
                'first_name' => $first_name,
                'last_name' => $last_name,
				'honorific' => $honorific,
                'role' => $role,
                'password' => $password,
				'phone' => $phone,
				'photo' => $photo
            );           
			//var_dump($informations);die();
            $custom_social = new SocialCustom();
           
            $result = $custom_social->db_save($informations);            
            return $result;
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

}
