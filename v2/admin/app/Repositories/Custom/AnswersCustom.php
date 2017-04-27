<?php

namespace App\Repositories\Custom;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\QuestionsCustom;

use App\Models\Answer;

class AnswersCustom {
    
    /*
     * Fields of table questions
     */
    protected $_id;
    protected $_question;
    protected $_content;    
    //protected $_score;
	//protected $_most_relevant;
	protected $_learner;
	protected $_instructor;
    protected $_model;
    protected $_row;
    protected $_accountsCustom;
	protected $_questionsCustom;
    
    public function __construct($id = null) {
        $this->_model = $this->model();
        $this->_accountsCustom = new AccountsCustom();
		$this->_questionsCustom = new QuestionsCustom();
        if($id){        
            $row = $this->_model->find($id);
            $this->_row = $row;
            if($row){
                $this->_id = $row->id;
                $this->_question = $row->question;
                $this->_content = $row->content;
                //$this->_score = $row->score;
				$this->_learner = $row->learner;
				$this->_learner = $row->learner;
				//$this->_most_relevant = $row->most_relevant;				
            }            
        }
        return $this;
    }

    public function model() {
        return new Answer();
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
				if (array_key_exists('content', $param)) {
                    if (is_null($param['content'])) {
                        $result = array("code" => 4000, "description" => "content is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['content'])) {
                        $result = array("code" => 4000, "description" => "content is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim(($param['content'])))) {
                        $result = array("code" => 4000, "description" => "content must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else{
					throw new Exception("Expected 'content' in array as parameter , " . (is_object($param['content']) ? get_class($param['content']) : gettype($param['content'])) . " found.");
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
				if (array_key_exists('question', $param)) {
					if (!is_null($param['question'])) {
						if (!is_numeric($param['question'])) {
							$result = array("code" => 4000, "description" => "question must be number ");
							echo json_encode($result, JSON_UNESCAPED_SLASHES);
							return false;
						}
						$question = $this->_questionsCustom->getPostByID($param['question']);
						if(!$question){
							LogRepository::printLog('error', "Invalid question ID {".$param['question']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
							$result = array("code" => 4015, "description" => "Invalid question ID");
							echo json_encode($result, JSON_UNESCAPED_SLASHES);
							return false;
						}						
					}
                }else{
                    throw new Exception("Expected numeric for key (question), " . (is_object($param['question']) ? get_class($param['question']) : gettype($param['question'])) . ' found.');
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
