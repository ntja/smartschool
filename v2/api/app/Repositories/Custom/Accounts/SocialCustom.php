<?php

namespace App\Repositories\Custom\Accounts;

use Exception;
use App\Repositories\Util\LogRepository;
use App\Repositories\Custom\AccountsCustom;
use App\Models\Account;
use Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class SocialCustom {

	const NETWORK_FACEBOOK = "facebook";
    const NETWORK_GOOGLE = "google";
	
    protected $_model;
	protected $_accountsCustom;

    public function __construct($id=null) {
        $this->_model = $this->model();
		 if($id){
            $this->_accountsCustom = new AccountsCustom($id);			
        }else{
            $this->_accountsCustom = new AccountsCustom();			
        }
        return $this;
    }


    public function model() {
        return new Account();
    }
    /**
     * valid param
     * 
     * @param array $param
     * @return boolean
     * @throws Exception
     */
    public function validate($params) {

        try {
         
            if (!is_array($params)){
                throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
            }

            if (!array_key_exists("network", $params)){
                throw new Exception("Expected key (network) in parameter array.");
            }                      
            if (!is_string($params['network'])) {
                $result = array("code" => 400, "description" => "network is a string");
                echo json_encode($result, JSON_UNESCAPED_SLASHES);
                return false;
            }    
			if(!in_array($param['network'],[self::NETWORK_FACEBOOK, self::NETWORK_GOOGLE])){
				$result = array("code" => 4000, "description" => "Expected 'facebook' or 'google' for key (network)");
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				return false;
			}
			
            return TRUE;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function db_save($params) {
        try { 
            $valid = $this->validate($params);
            if (!$valid) {
                http_response_code(400);
                die();
            }
            //var_dump($params);die();
            $network = $params['network'];
			
            if ($network == 'facebook') {                 
                if ($network_token) {                                       
                    if(!array_key_exists('third_party_id', $user)){
                        $result = array("code" => 4000, "description" => "third_party_id is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        http_response_code(400);
                        die();
                    }

                    if(!array_key_exists('id', $user)){
                        $result = array("code" => 4000, "description" => "facebook_id is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        http_response_code(400);
                        die();
                    }                                       
                    
                    $fcb_id = $user['id'];
                    $email = array_key_exists("email", $user) ? $user["email"] : '';
                    $third_party_id = $user['third_party_id']; 
                    $first_name = array_key_exists("first_name", $user) ? $user["first_name"] : null;
                    $last_name = array_key_exists("last_name", $user) ? $user["last_name"] : null;
                    
                    $account = new Account();
                    $user = $account::where('facebook_id', '=', $fcb_id)->first();                    
                    //if user found 
                    if($user){
                        //$res = $account::where('email', 'LIKE BINARY', $email)->first();                    
                        if ($user->email) {
                            $informations = array(
                                'email' => $user->email,
                                'password' => $third_party_id
                            );

                            $token = JWTAuth::attempt($informations);
                            $result = array(
                                'code' => 200,
                                'token' => $token,
                                'account_id' => $user->id,
                                'logged' => true
                            );
                            //var_dump($result);die();
                            LogRepository::printLog('info', "Successful authentication of account #{" . $user . "} through Facebook.");
                            //var_dump($result);die();
                            return $result;
                        } else {                            
                            $result = array(
                                'code' => 200,
                                'email' => $email,
                                'social_id' => $third_party_id,
                                'first_name' => $first_name,
                                'last_name' => $last_name,
                                'logged' => false
                            );
                            return $result;
                        }                                            
                    }else{
                        $result = array(
                            'code' => 200,
                            'email' => $email,
                            'social_id' => $third_party_id,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'facebook_id' => $fcb_id,
                            'logged' => false,                            
                        );
                        return $result;
                    }
                } else {
                    $result = array(
                        'code' => 400,
                        'error' => $resp
                    );
                    return $result;
                }
            } else if ($network == 'google') {                              
				$account = $this->_accountsCustom->checkUser($params["email"]);
				if($account){
					if($account->verified_status !== "VERIFIED"){
						LogRepository::printLog('error', "Invalid attempt to authenticate a non verified account " .$account);
							$result = array("code" => 4004, "description" => 'We have sent you a verification email. Please verify your email address so we know that it\'s really you !');
							return response()->json($result, 400);
					}
					if (!$token = JWTAuth::fromUser($account)) {
						LogRepository::printLog('error', "Invalid attempt to authenticate an account with inputs {" . var_export($params,true) . "}.");
						$result = array("code" => 4002, "description" => 'Authentication failed. Invalid email address or password');
						return response()->json($result, 400);
					}
					$account->is_active = 1;
					$account->date_updated = date('Y-m-d H:i:s');
					$account->last_login = date('Y-m-d H:i:s');
					$account->update();
					LogRepository::printLog('info', "Successful authentication of account " . $account . ".");
					$result = $this->prepareReponseAuthentication($account, $token);
					return $result;				
				}else{
					unset($params["network"]);
					//var_dump($params);die();
					$result = $this->_accountsCustom->dbSave($params);
					//var_dump($result);die();
					return $result;
				}
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
    public function prepareReponseAuthentication($account, $token) {
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

}
