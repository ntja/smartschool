<?php

namespace App\Http\Controllers\Accounts;

use Gate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Account;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\Accounts\AuthenticateCustom;
use App\Repositories\Custom\AccountsCustom;
use \App\Repositories\Custom\Resource\Accounts\Authenticate as ResourceAuthenticate;


class AuthenticateController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['post']]);
    }

    public function post(Request $request) {
        try {    
            $account = new AccountsCustom();
            $ressource_authenticate = new ResourceAuthenticate();
            if (Gate::forUser($account)->denies('post', $ressource_authenticate)) {
                $result = array("code" => 4003, "description" => "You do not have permissions for that request..");
                return response()->json($result,403);
            }
           $account_info = file_get_contents('php://input');
            $data = json_decode($account_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 400, "description" => "invalid request body");
                return response()->json($result, 400);
            }

            $email = array_key_exists("email", $data) ? $data["email"] : null;
            $password = array_key_exists("password", $data) ? $data["password"] : null;

            $informations = array(
                'email' => $email,
                'password' => $password,
            );
//            dd($informations);
            $custom_authenticate = new AuthenticateCustom();
            $result = $custom_authenticate->authenticate($informations);
            return $result;  
        } catch (JWTException $e) {
            LogRepo::printLog('error', $e->getMessage());
			return response()->json(['error' => 'could_not_create_token'], 500);
        }
    }

}
