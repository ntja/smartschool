<?php

namespace App\Repositories\Custom\Accounts\Account;


use App\Repositories\Util\LogRepository as LogRepo;
use Exception;
use App\Repositories\custom\AccountsCustom;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;

/**
 * Description of PasswordCustom (Update password)
 *
 * @author Jephte
 */
class PasswordCustom  {
    
    protected $_accountsCustom;
    
    public function __construct($id=null) {
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
    
    /*
     * Validate user inputs
     * @param Array $param 
     * @return boolean
     */
    public function validate($param){
        try{
            if (!is_array($param)) {
                throw new Exception("Expected array as parameter , " . (is_object($param) ? get_class($param) : gettype($param)) . " found.");
            }
            
            if (array_key_exists('new_password', $param)){
                if (!is_string($param['new_password'])) {
                    $result = array("code" => 400, "description" => "New password must be a string");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    return false;
                }                        
                
                if ((strlen($param['new_password']) < 8 )) {
                    $result = array("code" => 400, "description" => "New password must contain at least 8 characters");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    return false;
                }
            }else {
                throw new Exception("Expected 'new_password' in array as parameter , " . (is_object($param['new_password']) ? get_class($param['new_password']) : gettype($param['new_password'])) . " found.");
            }
            
            if (array_key_exists('password', $param)) {
                if (!is_string($param['password'])) {
                    $result = array("code" => 400, "description" => "current password must be a string");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    return false;
                }
                if ((strlen($param['password']) < 8 )) {
                    $result = array("code" => 400, "description" => "password must contain at least 8 characters");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    return false;
                }
            }else{
                throw new Exception("Expected 'password' in array as parameter , " . (is_object($param['password']) ? get_class($param['password']) : gettype($param['password'])) . " found.");
            }
                        
            
            return TRUE;
        }  catch (Exception $ex){
            LogRepo::printLog('error', $ex->getMessage());
        }
    }        
    
    /*
     * Update User password
     * @param Array $informations - current and new password
     * @return JSON response
     */
    public function updatePassword($informations){
        try{                                    
            $validation = $this->validate($informations);            
            if ($validation) {
                //var_dump($informations);die();
                // Get the user with its ID
                //$logged_account = $this->_accountsCustom->getInfoByID($informations['id']);
				 $logged_account = $this->_accountsCustom->getPropertyValue('row');
				 //var_dump($logged_account);die();
                if (!is_null($logged_account)) {
                    // Check if password matching the one store in database
                    if (Hash::check($informations['password'], $logged_account->password)) {
                        $logged_account->password = Hash::make($informations['new_password']);
                        $logged_account->date_updated = date("Y-m-d H:m:i");
                        $logged_account->update();
                        // Write in the log
                        LogRepo::printLog('info', "Password of account #{" . $informations['id'] . "} has just been updated.");
                        //  prepare the response
                        $result = $this->prepareReponseAfterPost($informations);                        
                        //  Return response
                        return $result;
                    } else {
                        // write in the log
                        LogRepo::printLog('error', "Password you want to update is invalid. Returned code: 4005.");
                        $result = array("code" => 400, "description" => "Invalid current password provided.");
                        return response()->json($result, 400);
                    }
                } else {
                    LogRepo::printLog('error', "Invalid attempt to update password of account #{".$informatios['id']."}");
                    $result = array("code" => 406, "description" => "Invalid request.");
                    return response()->json($result, 400);
                }
            } else {
                http_response_code(400);
                die();
            }
        }catch(Exception $ex){
            LogRepo::printLog('error', $ex->getMessage());
        }
    }
    
    /*
     * Response to be sent to user
     * @param array $param
     * @return JSON response
     */
    public function prepareReponseAfterPost($param){
        try {           
            $result = array(
                'code' => 200,
                'id' => $param['id'],                
            );
            return $result;
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
        }
    }
}
