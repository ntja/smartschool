<?php

namespace App\Repositories\Custom\Courses\Course;

use App\Repositories\Util\LogRepository;
use Exception;
use Mail;
use App\Models\JoinCourse;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\CoursesCustom;

class JoinCustom {
    
    const STATUS_ACCEPTED = "ACCEPTED";
    const STATUS_PENDING = "PENDING";
    const STATUS_REJECTED = "REJECTED";
    const STATUS_LEFT = "LEFT";

    const REQUESTED_BY_LEARNER = "LEARNER";
    const REQUESTED_BY_INSTRUCTOR = "INSTRUCTOR";

    /*
     * Fields of table Accounts
     */
    protected $_account;
    protected $_course;
    protected $_date_requested;
    protected $_date_joined;
    protected $_date_left;
    protected $_status;
    protected $_requestedby;
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
                $this->_account = $row->account;
                $this->_course = $row->course;
                $this->_date_requested = $row->date_requested;
                $this->_date_joined = $row->date_joined;
                $this->_date_left = $row->date_left;
                $this->_status = $row->status;
                $this->_requestedby = $row->requestedby;                
            }            
        }
        return $this;
    }

    public function model() {
        return new JoinCourse();
    }

    public function getRole(){               
        return $this->_role;
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
                if (array_key_exists('account', $param)) {
                    if (is_null($param['account'])) {
                        $result = array("code" => 4000, "description" => "account is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_numeric($param['account'])) {
                        $result = array("code" => 4000, "description" => "account must be a number ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                                        
                    
                    $row = $this->_accountCustom->getAccountByID($param['account']);
                    //var_dump($row);die();
                    if (!$row) {                        
                        LogRepository::printLog('error', "Invalid attempt join a course with an invalid account ID {".$param['account']."}. Returned code: 400. Request inputs  #" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "Invalid account ID");                       

                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if($row->role !== "LEARNER"){
                        LogRepository::printLog('error', "Invalid attempt join a course with an account ID {".$param['account']."} that does not correspond to a LEARNER user. Returned code: 400. Request inputs  #" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "account ID must correspond to a LEARNER user");

                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;                        
                    }
                }else{
                throw new Exception("Expected 'account' in array as parameter , " . (is_object($param['account']) ? get_class($param['account']) : gettype($param['account'])) . " found.");
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
                        LogRepository::printLog('error', "Invalid attempt join a course with an invalid course ID {".$param['course']."}. Returned code: 400. Request inputs  #" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "Invalid course ID");                       

                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                }else {
                    throw new Exception("Expected 'course' in array as parameter , " . (is_object($param['course']) ? get_class($param['course']) : gettype($param['course'])) . " found.");
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
                        $result = array("code" => 4000, "description" => "Role must not be empty");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if(isset($param['status'])){
                        if(!in_array($param['status'],[self::STATUS_LEFT, self::STATUS_REJECTED, self::STATUS_PENDING, self::STATUS_ACCEPTED])){
                            $result = array("code" => 4000, "description" => "Expected ".self::STATUS_ACCEPTED." or ".self::STATUS_REJECTED." or ".self::STATUS_PENDING." or ".self::STATUS_LEFT." for key (status)");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }
                }else {
                    throw new Exception("Expected 'status' in array as parameter , " . (is_object($param['status']) ? get_class($param['status']) : gettype($param['status'])) . " found.");
                }
                if (array_key_exists('requestedby', $param)){
                    if (is_null($param['requestedby'])) {
                        $result = array("code" => 4000, "description" => "requestedby is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    } 
                    if (!is_string($param['requestedby'])) {
                        $result = array("code" => 4000, "description" => "requestedby is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    } 
                    if(!in_array($param['requestedby'], [self::REQUESTED_BY_INSTRUCTOR, self::REQUESTED_BY_LEARNER])){
                        $result = array("code" => 4000, "description" => "requestedby should be one of these values : ".self::REQUESTED_BY_INSTRUCTOR." or ".self::REQUESTED_BY_LEARNER);
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                }else {
                    throw new Exception("Expected 'requestedby' in array as parameter , " . (is_object($param['requestedby']) ? get_class($param['requestedby']) : gettype($param['requestedby'])) . " found.");
                }
                if (array_key_exists('date_requested', $param)){
                    if (is_null($param['date_requested'])) {
                        $result = array("code" => 4000, "description" => "date_requested is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['date_requested'])) {
                        $result = array("code" => 4000, "description" => "date_requested must be a string");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else {
                    throw new Exception("Expected 'date_requested' in array as parameter , " . (is_object($param['date_requested']) ? get_class($param['date_requested']) : gettype($param['date_requested'])) . " found.");
                }
                if (array_key_exists('date_joined', $param)){
                    if (!is_null($param['date_joined'])) {
                        if (!is_string($param['date_joined'])) {
                            $result = array("code" => 4000, "description" => "date_joined must be a string");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                                                
                }
                if (array_key_exists('date_left', $param)){
                    if (!is_null($param['date_left'])) {
                        if (!is_string($param['date_left'])) {
                            $result = array("code" => 4000, "description" => "date_left must be a string");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                                            
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
    public function dbSave($params) {        
        try {                        
            $result = null;
            $valid = $this->validate($params);            
            if(!$valid){
                http_response_code(400);
                die(); 
            }            
            $application = $this->uniqueApplication($params['account'],$params['course']);
            //var_dump($application);die();
			// if user already applied to a course
            if($application){
				$result = array("code" => 4000, "description" => "The user #". $params['account'] ." already applied to course #".$params['course']);
                echo json_encode($result, JSON_UNESCAPED_SLASHES);
				http_response_code(400);
                die(); 
                /*
				$result = array(
                        "code" => 200, 
                        "account" => $application->account,
                        "course" => $application->course,
                        "date_requested" => $application->date_requested,
                        "date_joined" => $application->date_joined,
                        "status" => $application->status,
                    );              
                return $result;
				
				*/
            }else{
                $saved = $this->_model->dbSave($params);
                if($saved){             
                    $account = $this->_model->account;
                    $course = $this->_model->course;
                    $result = $this->prepareResponseAfterPost($course,$account);
                    //send  email to the user
                    /*
                    Mail::send('email.join-course',$params['account'],function((){
                        
                    });
                    */                
                    LogRepository::printLog('info', "The new application of user #".$account." to join course #".$course." has just been saved. Request inputs:  #{" . var_export($params,true) . "}.");
                }else{
                    http_response_code(400);
                    $result = array("code" => 4000, "description" => "An error occured. application has not been saved");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    die(); 
                }           
                return $result;
            }                           
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
   
   //check if a user already applied to a course
    public function prepareResponseAfterPost($course,$account) {
        try {         
            $result = array(
                'code' => 201,
                'course' => $course,
                'account' => $account,
                'links' =>
                    [
                        [
                            'href' => "/accounts/{$account}",
                            'rel' => 'retrieve',
                            'requestTypes' => array("GET"),
                            'responseTypes' => array("application/json")
                        ],
                        [                           
                            'href' => "/courses/{$course}",
                            'rel' => 'retrieve',
                            'requestTypes' => array("GET"),
                            'responseTypes' => array("application/json")                        
                        ]
                    ]
                );
            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }    
	
	//verifies if a couple (account, course) already exists
    public function uniqueApplication($account, $course) {
        try {
            $result = null;            
            $join_course = new JoinCourse();
            $result = $join_course::where('account', '=', $account)->where('course', '=', $course)->first();           
            return $result;
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
        }
        return $result;
    }
}
