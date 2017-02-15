<?php

namespace App\Repositories\Custom\Accounts\Account;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Repositories\Custom\CoursesCustom as Courses;
use App\Repositories\Custom\AccountsCustom;
//use App\Repositories\Custom\Courses\CategoriesCustom;

class CoursesCustom {        

	const STATUS_PUBLISHED = "PUBLISHED";
    const STATUS_UNPUBLISHED = "UNPUBLISHED";
	
    public $_courseCustom;
	public $_accountsCustom;

    public function __construct() {
        $this->_courseCustom = new Courses();
		$this->_accountsCustom = new AccountsCustom();
    }
    /**
     * Validate
     *
     * @param Array($mixed) $params Associative array of parameter 
     * @param Bolean $get_request bolean parameter to check if the request is POST or GET in order to perform validation     
     * @return Array(mixed) The result informations
     */
    public function validate($param, $account_id) {
        try {     
			if (array_key_exists("limit", $param)) {
				if (!is_numeric($param['limit'])) {
					$result = array("code" => 4000, "description" => "limit must be an integer");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
			}
			if(isset($param['status'])){
				if(!in_array($param['status'],[self::STATUS_PUBLISHED, self::STATUS_UNPUBLISHED])){
					$result = array("code" => 4000, "description" => "Expected ".self::STATUS_PUBLISHED. " or ". self::STATUS_UNPUBLISHED." for key (status)");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
			}
			if (!is_numeric($account_id)) {
				$result = array("code" => 4000, "description" => "Invalid object ID");
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				return false;
			}
			
			//check if the ID sent corresponds to an INSTRUCTOR account
			$user = $this->_accountsCustom->getAccountByID($account_id);
			if($user){
				if($user->role !== "INSTRUCTOR"){
					$result = array("code" => 4000, "description" => "Invalid object ID");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
			}else{
				$result = array("code" => 4000, "description" => "Invalid object ID");
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				return false;
			}			
			//var_dump($user->role);die();
            return true;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function getList($params,$role,$account){
        try{            
            //dd("Here");
            $validate = $this->validate($params,$account);            
            if ($validate) {                         
                //dd("Herexx");
                //Retrieve a list of item paginated by after and before params
                $rows = $this->_courseCustom->model()->getCourses($params, $role, $account);  
                LogRepository::printLog('info', "The courses of instructor #".var_export($account,true)." has been retrieve. Request inputs: {" . var_export($params,true) . "}.");    
                return $rows;
            }else{
				http_response_code(400);
                die();
			}       
        }catch(Exception $ex){
            LogRepository::printLog('error', $ex->getMessage());
        }
    }    
}
