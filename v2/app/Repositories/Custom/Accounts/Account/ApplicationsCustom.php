<?php

namespace App\Repositories\Custom\Accounts\Account;

use App\Repositories\Util\LogRepository;
use Exception;
//use App\Models\Course;
use App\Repositories\Custom\JoinCoursesCustom;

class ApplicationsCustom {
    
    /*
     * Fields of table Accounts
     */    

    protected $_joinCoursesCustom;

    public function __construct($id = null) {   
        $this->_joinCoursesCustom = new JoinCoursesCustom();          
    }   
        
    /**
     * Validate
     *
     * @param Array($mixed) $params Associative array of parameter 
     * @param Bolean $get_request bolean parameter to check if the request is POST or GET in order to perform validation     
     * @return Array(mixed) The result informations
     */
    public function validate($param) {
        try {            
            if (!is_array($param)) {
                throw new Exception("Expected array as parameter , " . (is_object($level) ? get_class($level) : gettype($level)) . " found.");
            }   
            /*                 
            if (!array_key_exists('id', $param)) {
                throw new Exception("Expected 'id' in array as parameter , " . (is_object($param['id']) ? get_class($param['id']) : gettype($param['id'])) . " found.");
            } 
            */          
            return TRUE;            
            return true;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }  

    public function getList($params,$account){
        try{            
            //dd("Here");
            //var_dump($account);die();
            $validate = $this->validate($params);            
            if ($validate) {                         
                //Retrieve a list of item paginated by after and before params
                $rows = $this->_joinCoursesCustom->model()->getApplication($params, $account->getPropertyValue('id'));  
                LogRepository::printLog('info', "All courses have been retrieve by user #".$account->getPropertyValue('id').". Request inputs: {" . var_export($params,true) . "}.");    
                return $rows;
            }            
        }catch(Exception $ex){
            LogRepository::printLog('error', $ex->getMessage());
        }
    }    
}
