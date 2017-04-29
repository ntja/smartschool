<?php

namespace App\Repositories\Custom\Courses\Course\Sections;

use App\Repositories\Util\LogRepository;
use Exception;
//use Mail;
use App\Models\CourseLesson;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Courses\Course\SectionsCustom;

class LessonsCustom {    

    /*
     * Fields of table course_sections
    */
	
    protected $_title;
    protected $_course;
    protected $_date_created;
    protected $_content;
    protected $_objective;

    protected $_accountCustom;
    protected $_courseCustom;
    
    public function __construct($id = null) {
        $this->_model = $this->model();
        $this->_accountCustom = new AccountsCustom();
        $this->_sectionCustom = new SectionsCustom();
        if($id){        
            $row = $this->_model->find($id);
            $this->_row = $row;
            if($row){
                $this->_title = $row->title;
                $this->_section = $row->section;
                $this->_content = $row->content;
                $this->_date_created = $row->date_created;
                $this->_objective = $row->objective;                
            }            
        }
        return $this;
    }

    public function model() {
        return new CourseLesson();
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
				
				if (array_key_exists('content', $param)) {
                    if (is_null($param['content'])) {
                        $result = array("code" => 4000, "description" => "content is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['content'])) {
                        $result = array("code" => 4000, "description" => "content must be a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
					
                }else{
					throw new Exception("Expected 'content' in array as parameter , " . (is_object($param['content']) ? get_class($param['content']) : gettype($param['content'])) . " found.");
                }
				
				if (array_key_exists('objective', $param)) {
                    if (is_null($param['objective'])) {
                        $result = array("code" => 4000, "description" => "objective is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['objective'])) {
                        $result = array("code" => 4000, "description" => "objective must be a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
					
                }else{
					throw new Exception("Expected 'objective' in array as parameter , " . (is_object($param['objective']) ? get_class($param['objective']) : gettype($param['objective'])) . " found.");
                }

                if (array_key_exists('section', $param)){
                    if (is_null($param['section'])) {
                        $result = array("code" => 4000, "description" => "section is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                   
                    if (!is_numeric($param['section'])) {
                        $result = array("code" => 4000, "description" => "section must be a number");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    $row = $this->_sectionCustom->getSectionByID($param['section']);
					//var_dump($row->course);die();
                    if (!$row) {                        
                        LogRepository::printLog('error', "Invalid attempt create a lesson with an invalid section ID {".$param['section']."}. Returned code: 400. Request inputs  #" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "Invalid section ID");                       

                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                }else {
                    throw new Exception("Expected 'section' in array as parameter , " . (is_object($param['section']) ? get_class($param['section']) : gettype($param['section'])) . " found.");
                }                                                                               
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
            $unique_lesson_title = $this->uniqueLessonPerSection($params['title'],$params['section']);
            //var_dump($unique_section_title);die();
			// if user already applied to a course
            if($unique_lesson_title){
                $result = array("code" => 4000, "description" => "The section #".$params['section']." already has the lesson '". $params['title']."'");
                echo json_encode($result, JSON_UNESCAPED_SLASHES);
                http_response_code(400);
                die(); 
            }
            $saved = $this->_model->DbSave($params);
            if($saved){             
                    $id = $this->_model->id;
                    $section = $this->_model->section;
                    $result = $this->prepareResponseAfterPost($id);				            
                    LogRepository::printLog('info', "The new lesson of section #".$section." has just been created. Request inputs:  #{" . var_export($params,true) . "}.");
            }else{
                    http_response_code(400);
                    $result = array("code" => 4000, "description" => "An error occured. Section has not been saved");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    die(); 
            }           
            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
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
            LogRepository::printLog('error', $ex->getMessage());
        }
    }    
	
	//verifies if a couple (title, course) already exists
    public function uniqueLessonPerSection($title, $section) {
        try {
            return $this->model()->where('title', 'LIKE', $title)->where('section', '=', $section)->first();           
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }		
}
