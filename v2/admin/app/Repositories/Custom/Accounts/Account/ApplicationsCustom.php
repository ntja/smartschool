<?php

namespace App\Repositories\Custom\Accounts\Account;

use App\Repositories\Util\LogRepository;
use Exception;
//use App\Models\Course;
use App\Repositories\Custom\JoinCoursesCustom;
use App\Repositories\Custom\Courses\CategoriesCustom;

class ApplicationsCustom {
    
    /*
     * Fields of table Accounts
     */    

    protected $_joinCoursesCustom;
	protected $_categoriesCustom;

    public function __construct($id = null) {   
        $this->_joinCoursesCustom = new JoinCoursesCustom();
		$this->_categoriesCustom = new CategoriesCustom();
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
                if(!$rows){					
					$result = [
                        'code' => 200,
                        'data' => [],
                        'total' => 0,
                    ];
                    return $result;
				}
				//var_dump($rows);die();
				for($i=0; $i<count($rows); $i++){
					$category_name = $this->_categoriesCustom->getcategoryByID($rows[$i]['course_details']->category);
					//var_dump($category_name);die();
					$rows[$i]['category'] = $category_name?$category_name->name:null;
				}
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
