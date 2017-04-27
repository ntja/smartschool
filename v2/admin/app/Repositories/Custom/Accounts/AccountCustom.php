<?php

namespace App\Repositories\Custom\Accounts;

use Exception;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Util\LogRepository as LogRepo;

class AccountCustom {
        
    const ROLE_CUSTOMER = "CUSTOMER";
    const ROLE_ENTREPRENEUR = "ENTREPRENEUR";
    const ROLE_ADVERTISER = "ADVERTISER";
    const ROLE_ADMIN = "ADMINISTRATOR";
    
    protected $_accountsCustom;	
    
    public function __construct($id=null) {		
        if($id){
            $this->_accountsCustom = new AccountsCustom($id);			
        }else{
            $this->_accountsCustom = new AccountsCustom();			
        }
        return $this;
    }
       
    /**
     * valid param
     * 
     * @param array $param
     * @return boolean
     * @throws Exception
     */
    public function validate($param) {        
        try{
            if (!is_array($param)) {
                throw new Exception("Expected array as parameter , " . (is_object($param) ? get_class($param) : gettype($param)) . " found.");
            }                      
            if (!array_key_exists('id', $param)) {
                throw new Exception("Expected 'id' in array as parameter , " . (is_object($param['id']) ? get_class($param['id']) : gettype($param['id'])) . " found.");
            }			
            return TRUE;            
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
        }
    }
    
    public function getAccount($informations){
        try{
			$account = $this->_accountsCustom->getAccountByID($informations['id']);
		   //var_dump($account);die();
		   //die();
			if($account){
			   LogRepo::printLog('info', "Account #" . $account->id . " information have just been fetched by account #{" . $this->_accountsCustom->getPropertyValue('id') . "}.");
				$result = $this->prepareReponseAfterGet($account);
				return $result;
			}else{
				http_response_code(400);
				LogRepo::printLog('error', "account #" . $informations['id'] . " not found");
				$result = array('code'=>4000,'description'=>"account #" . $informations['id'] . " not found");
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				die(); 
			}
        }catch(Exception $e){
            LogRepo::printLog('error', $e->getMessage());
        }
    }
    
    /**
     * Format of the response
     * 
     * @param array $param
     * @return array
     */
    public function prepareReponseAfterGet($account) {
        try {                    	        	
			$my_account['code'] = 200;
			$result = array(				                   
				'id'=>$account->id,
				'first_name'=>$account->first_name,
				'last_name'=>$account->last_name,
				'email'=>$account->email,
				'phone'=>$account->phone,                    
				'role'=>$account->role,
				'last_login'=>$account->last_login,
				'date_created'=>$account->date_created, 
				'verified_status'=>$account->verified_status,                    
				"honorific"=>$account->honorific,				
				"photo"=>$account->photo,
				"subscription"=>$account->subscription,
			);
            $my_account["account"] = $result;
            return $my_account;
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
        }
    }
}
