<?php

namespace App\Repositories\Custom\Courses\Course;

use App\Repositories\Util\LogRepository;
use Exception;
use Mail;
use App\Models\CourseSection;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\CoursesCustom;
use \Illuminate\Support\Str;

class SectionsCustom {        

    const IS_VISIBLE_0 = "0";
    const IS_VISIBLE_1 = "1";

    /*
     * Fields of table course_sections
     */
    protected $_title;
    protected $_course;
    protected $_date_created;
    protected $_description;
    protected $_is_visible;

    protected $_accountCustom;
    protected $_courseCustom;
    
    public function __construct($id = null) {
        $this->_model = $this->model();
        $this->_accountCustom = new AccountsCustom();
        $this->_courseCustom = new CoursesCustom();
        if($id){        
            $row = $this->_model->find($id);
            $this->_row = $row;
            if($row){
                $this->_title = $row->title;
                $this->_course = $row->course;
                $this->_description = $row->description;
                $this->_date_created = $row->date_created;
                $this->_is_visible = $row->is_visible;                
            }            
        }
        return $this;
    }

    public function model() {
        return new CourseSection();
    }
   
    public function getPropertyValue($key){
        $property_name = "_".$key;
        return $this->$property_name;
    }
    
        
    /**
     * Validate
     *
     * @param Array($mixed) $params Associative array of parameter 
     * @param Bolean $get_request bolean parameter to check if the request is POST or GET in order to perform validation     
     * @return Array(mixed) The result informations
     */
    public function validate($param, $get_request=false) {
        try {            
            if (!is_array($param)) {
                throw new Exception("Expected array as parameter , " . (is_object($level) ? get_class($level) : gettype($level)) . " found.");
            }
            
            if(!$get_request){
                if (array_key_exists('title', $param)) {
                    if (is_null($param['title'])) {
                        $result = array("code" => 4000, "description" => "title is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['title'])) {
                        $result = array("code" => 4000, "description" => "title must be a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
					
                }else{
					throw new Exception("Expected 'title' in array as parameter , " . (is_object($param['title']) ? get_class($param['title']) : gettype($param['title'])) . " found.");
                }
				
				if (array_key_exists('description', $param)) {
                    if (is_null($param['description'])) {
                        $result = array("code" => 4000, "description" => "description is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['description'])) {
                        $result = array("code" => 4000, "description" => "description must be a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
					
                }else{
					throw new Exception("Expected 'description' in array as parameter , " . (is_object($param['description']) ? get_class($param['description']) : gettype($param['description'])) . " found.");
                }

                if (array_key_exists('course', $param)){
                    if (is_null($param['course'])) {
                        $result = array("code" => 4000, "description" => "course is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                   
                    if (!is_numeric($param['course'])) {
                        $result = array("code" => 4000, "description" => "course must be a number");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    $row = $this->_courseCustom->getCourseByID($param['course']);
                    if (!$row) {                        
                        LogRepository::printLog('error', "Invalid attempt create a section with an invalid course ID {".$param['course']."}. Returned code: 400. Request inputs  #" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "Invalid course ID");                       

                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                }else {
                    throw new Exception("Expected 'course' in array as parameter , " . (is_object($param['course']) ? get_class($param['course']) : gettype($param['course'])) . " found.");
                }            
                
                if (array_key_exists('is_visible', $param)){                    
                    if (!is_numeric($param['is_visible'])) {
                        $result = array("code" => 4000, "description" => "is_visible must be a number");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                     
                    if(isset($param['is_visible'])){
                        if(!in_array($param['is_visible'],[self::IS_VISIBLE_0, self::IS_VISIBLE_1])){
                            $result = array("code" => 4000, "description" => "Expected ".self::IS_VISIBLE_0." or ".self::IS_VISIBLE_1." for key (is_visible)");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }
                }else {
                    throw new Exception("Expected 'is_visible' in array as parameter , " . (is_object($param['is_visible']) ? get_class($param['is_visible']) : gettype($param['is_visible'])) . " found.");
                }                                            
            }             
            return true;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }

    /**
     * db_save
     *
     * @param Array($mixed) $params Associative array of parameter     
     * @return Array(mixed) The result informations
     */
    public function DbSave($params) {        
        try {                        
            $result = null;
            $valid = $this->validate($params);            
            if(!$valid){
                http_response_code(400);
                die(); 
            }            
			$params['date_created'] = date('Y-m-d H:i:s');
            //var_dump($params);die();	
			$unique_section_title = $this->uniqueSectionPerCourse($params['title'],$params['course']);
            //var_dump($unique_section_title);die();
			// if user already applied to a course
            if($unique_section_title){
				$result = array("code" => 4000, "description" => "The course #".$params['course']." already has the section '". $params['title']."'");
                echo json_encode($result, JSON_UNESCAPED_SLASHES);
				http_response_code(400);
                die(); 
            }
			$saved = $this->_model->DbSave($params);
			if($saved){             
				$id = $this->_model->id;
				$course = $this->_model->course;
				$result = $this->prepareResponseAfterPost($id);				            
				LogRepository::printLog('info', "The new section of course #".$course." has just been created. Request inputs:  #{" . var_export($params,true) . "}.");
			}else{
				http_response_code(400);
				$result = array("code" => 4000, "description" => "An error occured. Section has not been saved");
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				die(); 
			}           
			return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }
   
   
    public function prepareResponseAfterPost($id) {
        try {         
            $result = array(
                'code' => 201,
                'id' => $id,
                );
            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }    
	
	//verifies if a couple (title, course) already exists
    public function uniqueSectionPerCourse($title, $course) {
        try {
            return $this->model()->where('title', 'LIKE', $title)->where('course', '=', $course)->first();           
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }
	
	public function getList($params,$id){
        try{            
            //dd("Here");
            $validate = $this->validate($params,true);            
            if ($validate) {                         
                //Retrieve a list of item paginated by after and before params
				
                $rows = $this->_model->getSections($params,$id);
                //var_dump($rows);die();
                if(!$rows){					
                    $result = [
                        'code' => 200,
                        'data' => [],
                        'total' => 0,
                    ];
                    return $result;
                }
				for($i=0; $i<count($rows);$i++){
                    //$row->title = Str::slug($row->title, '-');
                    for($j=0; $j<count($rows[$i]->lessons);$j++){
                        $rows[$i]->lessons[$j]->slug_title = Str::slug($rows[$i]->lessons[$j]->title);
                        //var_dump($rows[$i]->lessons[$j]->title);
                    }
                }
                return $rows;
            }else{
                http_response_code(400);
                die(); 
            }           
        }catch(Exception $ex){
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }
	
    public function getSectionByID($id){
        try{
            return $this->model()->with(['course'])->where('id', '=', $id)->first();
        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }
}
