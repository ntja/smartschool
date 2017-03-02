<?php

namespace App\Repositories\Custom;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Models\CourseCategory;
use App\Models\BookCategory;

class CategoriesCustom {
   
   const CATEGORY_BOOK = "book";
   const CATEGORY_COURSE = "course";
	
    public function __construct($id = null) {        
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
            if (array_key_exists('limit', $param)) {
				if (is_null($param['limit'])) {
					$result = array("code" => 4000, "description" => "limit is required ");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if (!is_numeric($param['limit'])) {
					$result = array("code" => 4000, "description" => "limit is a number ");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}                                      
			}else{
				throw new Exception("Expected 'limit' in array as parameter , " . (is_object($param['limit']) ? get_class($param['limit']) : gettype($param['limit'])) . " found.");
			}
			if (array_key_exists('type', $param)) {
				if (is_null($param['type'])) {
					$result = array("code" => 4000, "description" => "type is required ");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if (!is_string($param['type'])) {
					$result = array("code" => 4000, "description" => "type is a string ");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if (empty(trim($param['type']))) {
					$result = array("code" => 4000, "description" => "type must not be empty ");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if(!in_array($param['type'],[self::CATEGORY_BOOK, self::CATEGORY_COURSE])){
					$result = array("code" => 4000, "description" => "Expected ". self::CATEGORY_BOOK ." or ". self::CATEGORY_COURSE ."  for key (type)");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
			}else{
				throw new Exception("Expected 'type' in array as parameter , " . (is_object($param['type']) ? get_class($param['type']) : gettype($param['type'])) . " found.");
			}                
            return true;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
   
    public function getList($params,$account){
        try{            
            //dd("Here");
			$rows  = null;
            $validate = $this->validate($params);            
            if ($validate) {                         
                //Retrieve a list of item paginated by after and before params
				if($params['type'] == self::CATEGORY_BOOK){
					$book_category = new BookCategory();
					$rows = $book_category->getList($params);
				}else{
					$course_category = new CourseCategory();
					$rows = $course_category->getList($params);
				}
                
				if($rows){
					LogRepository::printLog('info', "All ".$params['type']."  categories have been retrieve by user #".$account->getPropertyValue('id').". Request inputs: {" . var_export($params,true) . "}.");    
					return $rows;
				}else{
					$result = [
                        'code' => 200,
                        'data' => [],
                        'total' => 0,
                    ];
                    return $result;
				}
            }else{
                http_response_code(400);
                die(); 
            }          
        }catch(Exception $ex){
            LogRepository::printLog('error', $ex->getMessage());
        }
    }    
}
