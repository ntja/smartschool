<?php

namespace App\Repositories\Custom\Courses;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Repositories\Custom\CoursesCustom as Courses;

class CourseCustom {        

	
    public $_courseCustom;
	public $_accountsCustom;

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
    public function validate($course) {
        try {     
		
			if (!is_numeric($course) && !is_string($course)) {
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

    public function getcourse($course){
        try{            
            //dd("Here");
            $validate = $this->validate($course);            
            if ($validate) {                         
                if(is_numeric($course)){
					$result = $this->_courseCustom->getCourseByID($course);
				}else{
					$result = $this->_courseCustom->getCourseByShortname($course);
				}                
                if($result){
					LogRepository::printLog('info', "The information of course #". $course ." has been retrieve."); 
					return $result;
				}else{
					 http_response_code(400);
					$result = array("code" => 4000, "description" => "Course not found");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					die(); 
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
