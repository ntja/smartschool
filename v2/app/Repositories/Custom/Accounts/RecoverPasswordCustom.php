<?php

namespace App\Repositories\Custom\Accounts;

use App\Repositories\Util\LogRepository;
use Exception;

use App\Repositories\Custom\AccountsCustom;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RecoverPassword;

class RecoverPasswordCustom {

    public function __construct() {
        return $this;
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
            
            if (array_key_exists('password', $param)){
				if (is_null($param['password'])) {
					$result = array("code" => 4000, "description" => "password is required");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if (!is_string($param['password'])) {
					$result = array("code" => 4000, "description" => "password must be a string");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if (strlen($param['password']) < 8 ) {
					$result = array("code" => 4000, "description" => " Minimum password length : 8 characters");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}  
			}else {
				throw new Exception("Expected 'password' in array as parameter , " . (is_object($param['password']) ? get_class($param['password']) : gettype($param['password'])) . " found.");
			}
			if (array_key_exists('confirm_password', $param)){
				if (is_null($param['confirm_password'])) {
					$result = array("code" => 4000, "description" => "confirm_password is required");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if (!is_string($param['confirm_password'])) {
					$result = array("code" => 4000, "description" => "confirm_password must be a string");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if (strlen($param['confirm_password']) < 8 ) {
					$result = array("code" => 4000, "description" => " Minimum confirm_password length : 8 characters");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				} 
				if ($param['password'] !== $param['confirm_password']) {
					$result = array("code" => 4000, "description" => "password and password_confirmation must match");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
			}else {
				throw new Exception("Expected 'confirm_password' in array as parameter , " . (is_object($param['confirm_password']) ? get_class($param['confirm_password']) : gettype($param['confirm_password'])) . " found.");
			}
            if (array_key_exists('id', $param)) {
                if (!is_numeric($param['id'])) {
                    $result = array("code" => 4000, "description" => "id must be a integer");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    return false;
                }
            }else{
                throw new Exception("Expected 'password' in array as parameter , " . (is_object($param['id']) ? get_class($param['id']) : gettype($param['id'])) . " found.");
            }                                
            return TRUE;
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
    public function recover_password($params) {
         if (!is_array($params)){
            throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
         }        
        $id_request = $params['id'];
        $new_password = $params['password'];
		
       $valid = $this->validate($params);
        if(!$valid){
            http_response_code(400);
           die(); 
        }
		//var_dump($id_request);die();
        $account_obj = new AccountsCustom(); 
		$custom_account = $account_obj->getAccountByID($id_request);
		//var_dump($custom_account);die();
		if($custom_account){
			//$id = $custom_account->getPropertyValue('id');
			//$logged_account = $custom_account->getPropertyValue('model')->find($id);
			//var_dump($custom_account);die();
			//var_dump($params);die();
			$custom_account->password = Hash::make($new_password); 
			$custom_account->date_updated = date("Y-m-d H:m:i");
			$custom_account->update();
			
			//send notification to user
			$custom_account->notify(new RecoverPassword($custom_account));
			$result = array(
				'code' => 200,
				'account_id' => $id_request              
			);
			LogRepository::printLog('info', "password of account #{".$custom_account->id."} has been successfully reset");
			return $result;
		} else{
			http_response_code(400);
			$result = array("code" => 4000, "description" => "Account not found");
			echo json_encode($result, JSON_UNESCAPED_SLASHES);
			die(); 
		}       
        
    }
}
