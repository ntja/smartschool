<?php

namespace App\Repositories\Custom\Accounts;

use App\Repositories\Util\LogRepository;
use Exception;

use App\Repositories\Custom\AccountsCustom;
use Crypt;
use App\models\Account;


class ForgotPasswordCustom {

    public function __construct() {
        return $this;
    }

    public function model() {
        return new Account();
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

            if (array_key_exists('email', $param)) {
                if (is_null($param['email'])) {
                    $result = array("code" => 4000, "description" => "email is required");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    return false;
                }
                if (!is_string($param['email'])) {
                    $result = array("code" => 4000, "description" => "email must be a string");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    return false;
                }
            }else{
                throw new Exception("Expected 'email' in array as parameter , " . (is_object($param['email']) ? get_class($param['email']) : gettype($param['email'])) . " found.");
            }            
            return TRUE;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

  
   /**
     * forgot password
     *
     * @param Array($mixed) $params Associative array of parameter
     * @param String $params["login"] The user email
     * @param String $params["password"] The user secret
     * @return Array(mixed) The result informations
     */
    public function forgot_password($params) {
        try{

        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
        $email = $params['email'];        
        $valid= $this->validate($params);
        if(!$valid){
            http_response_code(400);
           die(); 
        }

        $custom_account = new AccountsCustom();
        $info = $custom_account->checkUser($email);        
        if($info){
            //$logged_account = $custom_account->getPropertyValue('model')->find($info->id);  
            $result = array(
                'id' => $info->id,
                'date'=> date("Y-m-d H:m:i")
            );
            $secret = Crypt::encrypt(json_encode($result));
            //var_dump($secret);die();
            return $secret;
        }else{
            http_response_code(400);
            $result = array("code" => 4000, "description" => "Email address you provide does not exist in the system");
            echo json_encode($result, JSON_UNESCAPED_SLASHES);            
           die(); 
        }        
 
    }

}
