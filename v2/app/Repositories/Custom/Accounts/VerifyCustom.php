<?php

namespace App\Repositories\Custom\Accounts;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Repositories\Custom\AccountsCustom;


class VerifyCustom {

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

            if (array_key_exists('email', $param)){
				if (is_null($param['email'])) {
					$result = array("code" => 4000, "description" => "Email is required in query parameter");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if (!is_string($param['email'])) {
					$result = array("code" => 4000, "description" => "email is a string");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
			}else {
                throw new Exception("Expected 'email' in array as parameter , " . (is_object($param['email']) ? get_class($param['email']) : gettype($param['email'])) . " found.");
            }

            if (array_key_exists('token', $param)) {
				if (is_null($param['token'])) {
					$result = array("code" => 4000, "description" => "token is required in query parameter");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if (!is_string($param['token'])) {
					$result = array("code" => 4000, "description" => "token is a string");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
			}else{
                throw new Exception("Expected 'token' in array as parameter , " . (is_object($param['token']) ? get_class($param['token']) : gettype($param['token'])) . " found.");
            }                                   
            return TRUE;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
    
   /**
     * Verify
     *
     * @param Array($mixed) $params Associative array of parameter
     * @param String $params
     * @return Array(mixed) The result informations
     */
    public function verify($params) {
         
       $valid =  $this->validate($params);
		if(!$valid){
			http_response_code(400);
			die(); 
		} 
        $custom_account = new AccountsCustom();
        $account = $custom_account->verify($params['email'],$params['token']);

        if (!is_null($account)) {
			if($account->verified_status == "VERIFIED"){				
				//http_response_code(400);
				//$result = array("code" => 400,"description" => 'Account already verified');
				http_response_code(400);
				$result = array("code" => 4000, "description" => "Account already activated. Please Login");
				LogRepository::printLog('error', "Account".$account." already verified. inputs:  {". var_export($params,true)."}");
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				die(); 				
			}
			//$account->verify_token = null;
			$account->verified_status = "VERIFIED";
			$account->date_updated = date('Y-m-d H:i:s');
			//$account->verify_token = null;
			$account->update();
            LogRepository::printLog('info', "Successful activation of account #{" . $account . "}.");
            $result = $this->getResponse($account);
            return $result;
        } else {
			http_response_code(400);
            LogRepository::printLog('error', "Invalid verification attempt with inputs:  {". var_export($params,true)."}");
            $result = array("code" => 400,"description" => 'Invalid inputs. We cannot activate your account.');
			echo json_encode($result, JSON_UNESCAPED_SLASHES);
			die(); 				
            //return $result;
        }        
    }
	
	/**
     * Format of the response
     * 
     * @param array $param
     * @return array
     */
    public function getResponse($account) {
//        dd($token);
        try {
            $result = array(
                'code' => 200,
				'success' => 1,
				'message' => "Thank you for activating your account.",
                'account_id' => $account->id,
                'links' =>
                    [
						[
							'href' => "/accounts/{$account->id}",
                            'rel' => 'retrieve',
                            'requestTypes' => array("GET"),
                            'responseTypes' => array("application/json")
						],
						[							
                            'href' => "/accounts/authenticate",
                            'rel' => 'authenticate',
                            'requestTypes' => array("POST"),
                            'responseTypes' => array("application/json")                        
						]
					]				
            );

            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

}
