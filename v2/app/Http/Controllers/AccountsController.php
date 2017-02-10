<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Resource\Account as ResourceAccount;
use Exception;
use Mail;
//use JWTAuth;
//use JWTFactory;

class AccountsController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['post']]);
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
            $ressource_account = new ResourceAccount();
            if (Gate::forUser($account)->denies('post', $ressource_account)) {
                LogRepo::printLog('error', "Invalid attempt to create a new account with the role ".$account->getRole());
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result, 400);
            }
            $person_info = file_get_contents('php://input');
            $data = json_decode($person_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 400, "description" => "invalid request body");
                return response()->json($result, 400);
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
                'first_name' => $first_name,
                'last_name' => $last_name,
				'honorific' => $honorific,
                'role' => $role,
                'password' => $password,
				'phone' => $phone,
				'photo' => $photo
            );
			//var_dump($informations);die();
            $custom_account = new AccountsCustom($account_token_id);            
            $result = $custom_account->dbSave($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
        }
    }

    /**
     * Retrieve all user accounts by ADMIN.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request) {
         try {                                       
             //retrieving user ID based on its token
            $data = $request->only('limit', 'account_id','role','verified_status');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);			
            //checking user permission,
            $ressource_account = new ResourceAccount();
            if (Gate::forUser($account)->denies('get', $ressource_account)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result,400);
            }                       
            if (!$data['limit']) {
                $data['limit'] = 10; //set default value of limit param 
            }           
            $limit = $data['limit'];
            $role = $data["role"];
            $verified_status = $data["verified_status"];
            
            $informations = array(
                'limit' => $limit,                
                'role' => $role,
                'verified_status' => $verified_status,
            );            
			
            $custom_account = new AccountsCustom($account_token_id);			
			$result = $custom_account->getList($informations, $account_token_id);
            return response()->json($result);			
        } catch (Exception $e) {
            LogRepo::printLog('error', $e->getMessage());
        }
    }

}
