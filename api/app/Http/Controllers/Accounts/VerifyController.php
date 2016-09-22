<?php

namespace App\Http\Controllers\Accounts;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Accounts\VerifyCustom;
use App\Repositories\Custom\Resource\Accounts\Verify as ResourceAccount;
use Exception;
use Mail;
use JWTAuth;
use JWTFactory;

class VerifyController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['get']]);
    }    

    
    /**
     * Verify user account.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request) {
         try {                                       
             //retrieving user ID based on its token and query parameters
            $data = $request->only('email', 'verify_token','account_id');			
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);			
            //checking user permission,
            $ressource_account = new ResourceAccount();
            if (Gate::forUser($account)->denies('get', $ressource_account)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result,400);
            }                   
            $email = $data['email'];
            $token = $data["verify_token"];                                 
            
            $informations = array(
                'email' => $email,
                'token' => $token,                
            );            			
			//var_dump($informations);die();
            $custom_verify = new VerifyCustom($account_token_id);			
			$result = $custom_verify->verify($informations);                                                      
            return response()->json($result);			
        } catch (Exception $e) {
            LogRepo::printLog('error', $e->getMessage());
        }
    }
}
