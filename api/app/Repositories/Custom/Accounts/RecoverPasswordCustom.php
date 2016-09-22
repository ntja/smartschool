<?php

namespace App\Repositories\Custom\Accounts;

use App\Repositories\Util\LogRepository;
use Exception;

use App\Repositories\Custom\AccountsCustom;
use Illuminate\Support\Facades\Hash;

class RecoverPasswordCustom {

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
            
            if (array_key_exists('password', $param)) {
                if (!is_string($param['password'])) {
                    $result = array("code" => 4000, "description" => "password must be a string");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    return false;
                }
            }else{
                throw new Exception("Expected 'password' in array as parameter , " . (is_object($param['password']) ? get_class($param['password']) : gettype($param['password'])) . " found.");
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
        $custom_account = new AccountsCustom($id_request);        
        $id = $custom_account->getPropertyValue('id');        
        $logged_account = $custom_account->getPropertyValue('model')->find($id);
        //var_dump($params);die();
        $logged_account->password = Hash::make($new_password); 
        $logged_account->date_updated = date("Y-m-d H:m:i");
        $logged_account->update();
        
        $result = array(
            'code' => 200,
            'id' => $id              
        );
        LogRepository::printLog('info', "password of account #{".$logged_account->id."} has been successfully reset");
        return $result;
        }
}
