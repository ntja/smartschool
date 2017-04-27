<?php

namespace App\Repositories\Custom;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Repositories\Custom\AccountsCustom;

use App\Models\Question;

class QuestionsCustom {

    const IS_VISIBLE_1 = "1";
    const IS_VISIBLE_0 = "0";
    /*
     * Fields of table questions
     */
    protected $_id;
    protected $_title;
    protected $_description;    
    protected $_is_visible;
	protected $_learner;
	protected $_instructor;
    protected $_model;
    protected $_row;
    protected $_accountsCustom;
    
    public function __construct($id = null) {
        $this->_model = $this->model();
        $this->_accountsCustom = new AccountsCustom();
        if($id){        
            $row = $this->_model->find($id);
            $this->_row = $row;
            if($row){
                $this->_id = $row->id;
                $this->_title = $row->title;
                $this->_description = $row->description;
                $this->_is_visible = $row->is_visible;
				$this->_learner = $row->learner;
				$this->_learner = $row->learner;
            }            
        }
        return $this;
    }

    public function model() {
        return new Question();
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
            
            if($get_request){                             
            }else{
                if (array_key_exists('title', $param)) {
                    if (is_null($param['title'])) {
                        $result = array("code" => 4000, "description" => "title is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['title'])) {
                        $result = array("code" => 4000, "description" => "title is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim(($param['title'])))) {
                        $result = array("code" => 4000, "description" => "title must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else{
					throw new Exception("Expected 'title' in array as parameter , " . (is_object($param['title']) ? get_class($param['title']) : gettype($param['title'])) . " found.");
                }
				if (array_key_exists('description', $param)) {
                    if (is_null($param['description'])) {
                        $result = array("code" => 4000, "description" => "description is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['description'])) {
                        $result = array("code" => 4000, "description" => "description is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim(($param['description'])))) {
                        $result = array("code" => 4000, "description" => "description must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else{
					throw new Exception("Expected 'description' in array as parameter , " . (is_object($param['description']) ? get_class($param['description']) : gettype($param['description'])) . " found.");
                }
				
				if (array_key_exists('is_visible', $param)) {
                    if(isset($param['is_visible']) && !in_array($param['is_visible'],[self::IS_VISIBLE_0, self::IS_VISIBLE_1])){
                        $result = array("code" => 4000, "description" => "Expected ". self::IS_VISIBLE_0 ." or ". self::IS_VISIBLE_1 ."  for key (is_visible)");
						echo json_encode($result, JSON_UNESCAPED_SLASHES);
						return false;
                    }
                }else{
                    throw new Exception("Expected ". self::IS_VISIBLE_0 ." or ". self::IS_VISIBLE_1 ." for key (is_visible), " . (is_object($param['is_visible']) ? get_class($param['is_visible']) : gettype($param['is_visible'])) . ' found.');
                }
				
                if (array_key_exists('learner', $param)) {
					if (!is_null($param['learner'])) {
						if (!is_numeric($param['learner'])) {
							$result = array("code" => 4000, "description" => "learner must be number ");
							echo json_encode($result, JSON_UNESCAPED_SLASHES);
							return false;
						}
						$learner = $this->_accountsCustom->getAccountByID($param['learner']);
						if(!$learner){
							LogRepository::printLog('error', "Invalid learner ID {".$param['learner']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
							$result = array("code" => 4015, "description" => "Invalid learner ID");
							echo json_encode($result, JSON_UNESCAPED_SLASHES);
							return false;
						}           
						if($learner->role != 'LEARNER'){
							LogRepository::printLog('error', "Invalid learner ID {".$param['learner']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
							$result = array("code" => 4016, "description" => "Invalid learner ID - The ID you provided does not correspond to a LEARNER");
							echo json_encode($result, JSON_UNESCAPED_SLASHES);
							return false;
						}
					}
                }else{
                    throw new Exception("Expected numeric for key (learner), " . (is_object($param['learner']) ? get_class($param['learner']) : gettype($param['learner'])) . ' found.');
                }
				
				if (array_key_exists('instructor', $param)) {
					if (!is_null($param['instructor'])) {
						if (!is_numeric($param['instructor'])) {
							$result = array("code" => 4000, "description" => "instructor must be a number ");
							echo json_encode($result, JSON_UNESCAPED_SLASHES);
							return false;
						}
						$instructor = $this->_accountsCustom->getAccountByID($param['instructor']);
						if(!$instructor){
							LogRepository::printLog('error', "Invalid instructor ID {".$param['instructor']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
							$result = array("code" => 4015, "description" => "Invalid instructor ID");
							echo json_encode($result, JSON_UNESCAPED_SLASHES);
							return false;
						} 
						if($instructor->role != 'INSTRUCTOR'){
							LogRepository::printLog('error', "Invalid instructor ID {".$param['instructor']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
							$result = array("code" => 4016, "description" => "Invalid instructor ID - The ID you provided does not correspond to an INSTRUCTOR");
							echo json_encode($result, JSON_UNESCAPED_SLASHES);
							return false;
						}
					}
                }else{
                    throw new Exception("Expected numeric for key (instructor), " . (is_object($param['instructor']) ? get_class($param['instructor']) : gettype($param['instructor'])) . ' found.');
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
     * @param String $params["email"] The user login
     * @param String $params["role"] The user role
     * @param String $params["password"] The user secret
     * @return Array(mixed) The result informations
     */
    public function dbSave($params) {
        try {                        
            $result = null;
            $valid = $this->validate($params);            
            if(!$valid){
                http_response_code(400);
                die(); 
            }            
            $saved = $this->_model->dbSave($params);
            if($saved){             
                $question_id = $this->_model->id;                
                $result = $this->prepareResponseAfterPost($params,$question_id);                
                LogRepository::printLog('info', "The question #".$question_id." has just been created. Request inputs:  #{" . var_export($params,true) . "}.");
            }else{
                http_response_code(400);
                $result = array("code" => 4000, "description" => "An error occured. Question has not been posted");
                echo json_encode($result, JSON_UNESCAPED_SLASHES);
                die(); 
            }           
            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
   
    public function prepareResponseAfterPost($param,$id) {
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
	
    public function getPostByID($id){
        try{
            $row = $this->model()->where('id', '=', $id)->first();
            return $row;
        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
    
}
