<?php

namespace App\Repositories\Custom\Accounts\Account;

use App\Repositories\Util\LogRepository;
use Exception;
//use App\Models\Course;
use App\Repositories\Custom\CoursesCustom as Courses;
//use App\Repositories\Custom\SchoolsCustom;
//use App\Repositories\Custom\Courses\CategoriesCustom;

class CoursesCustom {        

    public $_courseCustom;

    public function __construct() {
        $this->_courseCustom = new Courses();
    }
    /**
     * Validate
     *
     * @param Array($mixed) $params Associative array of parameter 
     * @param Bolean $get_request bolean parameter to check if the request is POST or GET in order to perform validation     
     * @return Array(mixed) The result informations
     */
    public function validate($param, $get=true) {
        try {                        
            return true;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function getList($params,$role,$account){
        try{            
            //dd("Here");
            $validate = $this->validate($params,true);            
            if ($validate) {                         
                //dd("Herexx");
                //Retrieve a list of item paginated by after and before params
                $rows = $this->_courseCustom->model()->getCourses($params, $role, $account);  
                LogRepository::printLog('info', "The courses of instructor #".var_export($account,true)." has been retrieve. Request inputs: {" . var_export($params,true) . "}.");    
                return $rows;
            }            
        }catch(Exception $ex){
            LogRepository::printLog('error', $ex->getMessage());
        }
    }    
}
