<?php

namespace App\Repositories\Custom\Accounts;

use App\Repositories\Util\LogRepository;
use Exception;

use App\Repositories\Custom\AccountsCustom;
use JWTAuth;


class AuthenticateCustom {

    public function __construct() {
        return $this;
    }

    public function model() {
        return \App\Models\Accounts::class;
    }

    /**
     * Validate
     *
     * @param Array($mixed) $params Associative array of parameter
     * @param String $params["login"] The user email
     * @param String $params["password"] The user secret
     * @return Array(mixed) The result informations
     */
    public function validate($param) {

        try {
            if (!is_array($param)) {
                throw new Exception("Expected array as parameter , " . (is_object($param) ? get_class($param) : gettype($param)) . " found.");
            }
            $errors = [];
            if (array_key_exists('email', $param)){
            if (is_null($param['email'])) {
                    $errors [] = array("code" => 4000, "field" =>"'email'","description" => "email is required ");
                    //echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    //return false;
            }
            if (!is_string($param['email'])) {
                    $errors [] = array("code" => 4000,"field" =>"'email'", "description" => "email must be a string");
                    //echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    //return false;
            }
            }else {
                throw new Exception("Expected 'email' in array as parameter , " . (is_object($param['email']) ? get_class($param['email']) : gettype($param['email'])) . " found.");
            }

            if (array_key_exists('password', $param)) {
            if (is_null($param['password'])) {
                    $errors [] = array("code" => 4000,"field" =>"'password'", "description" => "password is required ");
                    //echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    //return false;
            }
            if (!is_string($param['password'])) {
                    $errors [] = array("code" => 4000,"field" =>"'password'", "description" => "password must be a string");
                    //echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    //return false;
            }
            }else{
                throw new Exception("Expected 'password' in array as parameter , " . (is_object($param['password']) ? get_class($param['password']) : gettype($param['password'])) . " found.");
            }
            if (array_key_exists('human_verification', $param)){
                if (is_null($param['human_verification'])) {
                    $errors [] = array("code" => 4000, "field" =>"'human_verification'","description" => "human_verification is required ");
                    //echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    //return false;
                }
                if (!is_numeric($param['human_verification'])) {
                    $errors [] = array("code" => 4000, "description" => "human_verification must be a number");
                    //echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    //return false;
                }
                if ($param['human_verification'] != 4) {
                    $errors [] = array("code" => 4000, "field" =>"'human_verification'", "description" => "human_verification value is incorrect");
                    //echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    //return false;
                }
            }else {
                throw new Exception("Expected 'human_verification' in array as parameter , " . (is_object($param['human_verification']) ? get_class($param['human_verification']) : gettype($param['human_verification'])) . " found.");
            }
            if($errors){
                    return $errors;
            }else{
                    return true;
            }

        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    /**
     * Format of the response
     * 
     * @param array $param
     * @return array
     */
    public function prepareReponseAfterPost($account, $token) {
//        dd($token);
        try {
            $result = array();
            $validity = config('jwt.ttl');
            $result = array(
                'code' => 200,
                'account_id' => $account->id,
                'role' => $account->role,
                'token' => $token,
                'validity' => $validity,
            );

            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
   /**
     * Authenticate
     *
     * @param Array($mixed) $params Associative array of parameter
     * @param String $params["login"] The user email
     * @param String $params["password"] The user secret
     * @return Array(mixed) The result informations
     */
    public function authenticate($params) {
         if (!is_array($params))
                throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');

            if (!array_key_exists("email", $params)){
                throw new Exception("Expected key (email) in parameter array.");
            }

            if (!is_string($params["email"])){
                throw new Exception("Expected String for key (email) in parameter array , " . (is_object($params["email"]) ? get_class($params["email"]) : gettype($params["email"])) . " found.");
            }

            if (!array_key_exists("password", $params)){
                throw new Exception("Expected key (password) in parameter array.");
            }

            if (!is_string($params["password"])){
                throw new Exception("Expected String for key (password) in parameter array , " . (is_object($params["password"]) ? get_class($params["password"]) : gettype($params["password"])) . " found.");
            }

		$result = $this->validate($params);   
		//var_dump($result);die();
		if($result !== true){
			//http_response_code(400);
			//die();
			return response()->json($result, 400);
		}
        
		unset($params['human_verification']);
        $custom_account = new AccountsCustom();
        $account = $custom_account->checkUser($params['email']);        
        //var_dump($account);die();
		$result = [];
        if (!is_null($account)) {
            if($account->verified_status !== "VERIFIED"){
                LogRepository::printLog('error', "Invalid attempt to authenticate a non-verified account " .$account);
                    $result [] = array("code" => 4004, "description" => 'We have sent you a verification email. Please verify your email address so we know that it\'s really you !');
                    return response()->json($result, 400);
            }
            if (!$token = JWTAuth::attempt($params)) {
				LogRepository::printLog('error', "Invalid attempt to authenticate an account with inputs {" . var_export($params,true) . "}.");
                $result []  = array("code" => 4002, "description" => 'Authentication failed. Invalid email address or password');
                return response()->json($result, 400);
            }
			$account->is_active = 1;
			$account->date_updated = date('Y-m-d H:i:s');
            $account->last_login = date('Y-m-d H:i:s');
			$account->update();
            LogRepository::printLog('info', "Successful authentication of account " . $account . ".");
            $result = $this->prepareReponseAfterPost($account, $token);
            return $result;
        } else {
            LogRepository::printLog('error', "Invalid authentication attempt with inputs:  {". var_export($params,true)."}");
            $result [] = array("code" => 4003,"description" => 'Invalid credentials');
            return response()->json($result, 400);
        }
        
    }
}
