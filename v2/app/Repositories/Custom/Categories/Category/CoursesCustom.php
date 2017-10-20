<?php

namespace App\Repositories\Custom\Categories\Category;

use App\Repositories\Util\LogRepository;
use Exception;
use DB;
use App\Repositories\Custom\CoursesCustom as Course;

class CoursesCustom {
    
    protected $_model;
    protected $_row;
    protected $_coursesCustom;

    public function __construct($id = null) {
        //$this->_model = $this->model();       
        $this->_coursesCustom = new Course();        
        return $this;
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
            if (array_key_exists('category', $param)) {
				if (!is_numeric($param['category'])) {
					$result = array("code" => 4000, "description" => "category is an integer", "field" => "category");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				$category = DB::table("course_categories")->where("id",$param['category'])->first();
				if(!$category){
					LogRepository::printLog('error', "Invalid category ID {".$param['category']."}. Request inputs :" . var_export($param,true) . ".");
					$result = array("code" => 4011, "description" => "Invalid category ID");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
                }
			}else{
				throw new Exception("Expected 'id' in array as parameter , " . (is_object($param['id']) ? get_class($param['id']) : gettype($param['id'])) . " found.");
			}
            return true;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }

    public function getList($params,$account){
        try{            
            //dd("Here");
            $validate = $this->validate($params);            
            if ($validate) {
                //Retrieve a list of item paginated by after and before params
                $rows = $this->_coursesCustom->model()->getCourses($params,$account);
				if($rows){					
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
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }    
}
