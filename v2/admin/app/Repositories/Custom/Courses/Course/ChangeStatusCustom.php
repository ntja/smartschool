<?php

namespace App\Repositories\Custom\Courses\Course;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Repositories\Custom\CoursesCustom;

class ChangeStatusCustom {
    
    const STATUS_PUBLISHED = "PUBLISHED";
    const STATUS_UNPUBLISHED = "UNPUBLISHED";
   
    /*
     * Fields of table Accounts
     */
    protected $_courseCustom;
    
    public function __construct($id = null) {
        
        if($id){        
            $this->_courseCustom = new CoursesCustom($id);           
        }else{
			$this->_courseCustom = new CoursesCustom();
		}
        return $this;
    }  
  
    /**
     * Validate
     *
     * @param Array($mixed) $param Associative array of parameter 
     * @param Bolean $get_request bolean parameter to check if the request is POST or GET in order to perform validation     
     * @return Array(mixed) The result informations
     */
    public function validate($param) {
        try {            
            if (!is_array($param)) {
                throw new Exception("Expected array as parameter , " . (is_object($level) ? get_class($level) : gettype($level)) . " found.");
            }				
			if (array_key_exists('status', $param)){
				if (is_null($param['status'])) {
					$result = array("code" => 4000, "description" => "status is required");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if (!is_string($param['status'])) {
					$result = array("code" => 4000, "description" => "status must be a string");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				} 
				if (empty(trim($param['status']))) {
					$result = array("code" => 4000, "description" => "status must not be empty");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if(isset($param['status'])){
					if(!in_array($param['status'],[self::STATUS_PUBLISHED, self::STATUS_UNPUBLISHED])){
						$result = array("code" => 4000, "description" => "Expected ".self::STATUS_PUBLISHED." or ".self::STATUS_UNPUBLISHED." for key (status)");
						echo json_encode($result, JSON_UNESCAPED_SLASHES);
						return false;
					}
				}
			}else {
				throw new Exception("Expected 'status' in array as parameter , " . (is_object($param['status']) ? get_class($param['status']) : gettype($param['status'])) . " found.");
			}
            return true;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    /**
     * db_save
     *
     * @param Array($mixed) $params Associative array of parameter     
     * @return Array(mixed) The result informations
     */
    public function changeStatus($params, $id) {        
        try {                        
            $result = null;
            $valid = $this->validate($params);            
            if(!$valid){
                http_response_code(400);
                die(); 
            }            
           $course = $this->_courseCustom->getCourseByID($id);
			if (!$course) {                        
				LogRepository::printLog('error', "Invalid attempt to change the status a course with an invalid course ID {".$params['course']."}. Returned code: 400. Request inputs  #" . var_export($params,true) . ".");
				$result = array("code" => 4001, "description" => "Invalid course ID");                       
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				http_response_code(400);
				die();
			}else{
				if($course->status == $params['status']){					
                    $result = array("code" => 4000, "description" => "This course is already {$params['status']}");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
					http_response_code(400);
                    die(); 
				}
				$course->status = $params['status'];
				$course->save();
				$result = $this->prepareResponseAfterPut($course);                                 
				LogRepository::printLog('info', "The course #".$id." has just been {$params['status']}. Request inputs:  #{" . var_export($params,true) . "}.");
                return $result;
            }                           
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
   
   //prepare response
    public function prepareResponseAfterPut($course) {
        try {         
            $result = array(
                'code' => 200,
                'course_id' => $course->id,
                'status' => $course->status,                
                );
            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }    		
}
