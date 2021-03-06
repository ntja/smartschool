<?php

namespace App\Repositories\Custom;

use App\Repositories\Util\LogRepository;
use Exception;
//use Validator;
use Illuminate\Notifications\Notification;
use Mail;
use App\Models\Account;
use App\Notifications\EmailVerification;
use DB;

class AccountsCustom {

    const ROLE_GUEST = "GUEST";
    const ROLE_LEARNER = "LEARNER";
    const ROLE_INSTRUCTOR = "INSTRUCTOR";
    const ROLE_PARENT = "PARENT";    
    
    const HONORIFIC_MR = "Mr";
    const HONORIFIC_MS = "Ms";
    const HONORIFIC_MISS = "Miss";

    const VERIFY_STATUS_PENDING = "PENDING";
    const VERIFY_STATUS_VERIFY = "VERIFIED";

    const SUBSCRIPTION_PAID = "PAID";
    const SUBSCRIPTION_UNPAID = "UNPAID";
    
    /*
     * Fields of table Accounts
     */
    protected $_id;
    protected $_email;
    protected $_password;
    protected $_first_name;
    protected $_last_name;
    protected $_role;
    protected $_is_active;
    protected $_verified_status;
    protected $_phone;
    protected $_photo;
    protected $_honorific;
    protected $_date_created;
    protected $_date_updated;
    protected $_last_login;
    protected $_verify_token;
    protected $_model;
    protected $_row;
    
    public function __construct($id = null) {
        $this->_model = $this->model();     
        if($id){        
            $row = $this->_model->find($id);
            $this->_row = $row;
            if($row){
                $this->_id = $row->id;
                $this->_email = $row->email;
                $this->_password = $row->password;
                $this->_first_name = $row->first_name;
                $this->_last_name = $row->last_name;
                $this->_role = $row->role;
                $this->_is_active = $row->is_active;
                $this->_verified_status = $row->verified_status;                
                $this->_phone = $row->phone;
                $this->_photo = $row->photo;
                $this->_honorific = $row->honorific;
                $this->_date_created = $row->date_created;
                $this->_date_updated = $row->date_updated;
                $this->_last_login = $row->last_login;
                //$this->_recovery_hash = $row->password_recovery_hash;        
            }            
        }else{
            $this->_role = self::ROLE_GUEST;
        }
        return $this;
    }

    public function model() {
        return new Account();
    }

    public function getRole(){               
        return $this->_role;
    }
    
    public function getPropertyValue($key){
        $property_name = "_".$key;
        return $this->$property_name;
    }
    
    public function isOwner($resource) {
        //var_dump($resource);die();
        return $this->_id == $resource->id;
        
    }

    public function isCourseOwner($resource) {
        //var_dump($resource);die();
        $course = DB::table('courses')->where('id',$resource->id)->first();
        return $this->_id == $course->instructor;
        
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
                              
                if (array_key_exists('role', $param)) {
                    if(isset($param['role']) && !in_array($param['role'],[self::ROLE_CUSTOMER, self::ROLE_ENTREPRENEUR, self::ROLE_ADVERTISER])){
                        $result = array("code" => 4000, "description" => "Expected LEARNER or INSTRUCTOR or PARENT for key (role)");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                    }
                }else{
                    throw new Exception("Expected LEARNER or INSTRUCTOR or PARENT for key (role), " . (is_object($param['role']) ? get_class($param['role']) : gettype($param['role'])) . ' found.');
                }                                
                if (array_key_exists('verified_status', $param)) {
                    if(isset($param['verified_status']) && !in_array($param['verified_status'],[self::VERIFY_STATUS_VERIFY, self::VERIFY_STATUS_PENDING])){
                        $result = array("code" => 4000, "description" => "Expected PENDING or VERIFY for key (verified_status)");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                    }
                }else{
                    throw new Exception("Expected 'verified_status' in array as parameter , " . (is_object($param['verified_status']) ? get_class($param['verified_status']) : gettype($param['verified_status'])) . " found.");
                }                  
            }else{
                if (array_key_exists('email', $param)) {
                    if (is_null($param['email'])) {
                        $result = array("code" => 4000, "description" => "Email is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['email'])) {
                        $result = array("code" => 4000, "description" => "Email is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim($param['email']))) {
                        $result = array("code" => 4000, "description" => "Email must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    $account = new Account();
                    $email = $account::where('email', 'LIKE BINARY', $param['email'])->first();                                                                                                
                    if ($email) {
                        unset($param['password']);
                        LogRepository::printLog('error', "Invalid attempt to create a new account with an email taken {".$param['email']."}. Returned code: 400. Request inputs  #" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "Email address already in use");                       

                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                }else{
                throw new Exception("Expected 'email' in array as parameter , " . (is_object($param['email']) ? get_class($param['email']) : gettype($param['email'])) . " found.");
                }

                if (array_key_exists('first_name', $param)){
                    if (is_null($param['first_name'])) {
                        $result = array("code" => 4000, "description" => "first_name is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                   
                    if (!is_string($param['first_name'])) {
                        $result = array("code" => 4000, "description" => "first_name is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim($param['first_name']))) {
                        $result = array("code" => 4000, "description" => "first_name must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                }else {
                    throw new Exception("Expected 'first name' in array as parameter , " . (is_object($param['first_name']) ? get_class($param['first_name']) : gettype($param['first_name'])) . " found.");
                }            

                if (array_key_exists('last_name', $param)){
                    if (is_null($param['last_name'])) {
                        $result = array("code" => 4000, "description" => "last_name is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['last_name'])) {
                        $result = array("code" => 4000, "description" => "last_name is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim($param['last_name']))) {
                        $result = array("code" => 4000, "description" => "last_name must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                }else {
                    throw new Exception("Expected 'last_name' in array as parameter , " . (is_object($param['last_name']) ? get_class($param['last_name']) : gettype($param['last_name'])) . " found.");
                }                        
                if (array_key_exists('role', $param)){
                    if (is_null($param['role'])) {
                        $result = array("code" => 4000, "description" => "role is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['role'])) {
                        $result = array("code" => 4000, "description" => "role must be a string");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    } 
                    if (empty(trim($param['role']))) {
                        $result = array("code" => 4000, "description" => "Role must not be empty");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if(isset($param['role']) && SELF::ROLE_GUEST === $this->_role){
                        if(!in_array($param['role'],[self::ROLE_LEARNER, self::ROLE_INSTRUCTOR, self::ROLE_PARENT])){
                            $result = array("code" => 4000, "description" => "Expected LEARNER or INSTRUCTOR or PARENT for key (role)");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }
                }else {
                    throw new Exception("Expected 'role' in array as parameter , " . (is_object($param['role']) ? get_class($param['role']) : gettype($param['role'])) . " found.");
                }
                if (array_key_exists('honorific', $param)){
                    if (is_null($param['honorific'])) {
                        $result = array("code" => 4000, "description" => "honorific is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    } 
                    if (!is_string($param['honorific'])) {
                        $result = array("code" => 4000, "description" => "honorific is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    } 
                    if(!in_array($param['honorific'], [self::HONORIFIC_MR, self::HONORIFIC_MS, self::HONORIFIC_MISS])){
                        $result = array("code" => 4000, "description" => "honorific should be one of these values : ".self::HONORIFIC_MR." or ".self::HONORIFIC_MS." or ".self::HONORIFIC_MISS);
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                }else {
                    throw new Exception("Expected 'honorific' in array as parameter , " . (is_object($param['honorific']) ? get_class($param['honorific']) : gettype($param['honorific'])) . " found.");
                }
                if (array_key_exists('password', $param)){
                    if (is_null($param['password'])) {
                        $result = array("code" => 4000, "description" => "password is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['password'])) {
                        $result = array("code" => 4000, "description" => "password must be a string");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (strlen($param['password']) < 8 ) {
                        $result = array("code" => 4000, "description" => " Minimum password length : 8 characters");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }  
                }else {
                    throw new Exception("Expected 'password' in array as parameter , " . (is_object($param['password']) ? get_class($param['password']) : gettype($param['password'])) . " found.");
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
            $params['date_created'] = date('Y-m-d H:i:s');
            $params['verify_token'] = str_random(50);            
            $saved = $this->_model->dbSave($params);
            if($saved){             
                $account_id = $this->_model->id;                
                $result = $this->prepareResponseAfterPost($params,$account_id);
                //$x = new EmailVerification($this->_model);
                //var_dump($result);die();
                //send verification email to the user
                //Notification::send($this->_row, new EmailVerification($this->_row));
                //var_dump($this->_model);die();                
                /**/
				$email = $params['email'];
				$verify_token = $params['verify_token'];
				$send = Mail::send('mails.verification', ['email' => $email,'verify_token' => $verify_token], function ($m) use ($email) {						  
						  $m->to($email)
							->subject('Activate your account on SmartSchool');
				});
				//var_dump($send);die();
				//LogRepository::printLog('warning', $send);
                if(count(Mail::failures()) > 0){
                    LogRepository::printLog('warning', "An error occured. Verification email could not be sent.");
                      $result=array(
                        'code'=>'4000',
                        'description'=>'An error occured. Verification email could not be sent.'
                        );
                    return response()->json($result, 400);
                }
               
                //$this->_model->notify(new EmailVerification($this->_model));
                unset($params['password']);
                LogRepository::printLog('info', "The new account #".$account_id." has just been created. Request inputs:  #{" . var_export($params,true) . "}.");
            }else{
                http_response_code(400);
                $result = array("code" => 4000, "description" => "An error occurred. Account has not been created");
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
                'links' =>
                    [
                        [
                            'href' => "/accounts/{$id}",
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

    /**
     * get_list
     *
     * @param Array($mixed) $params Associative array of parameter     
     * @return Array(mixed) The result informations
     */
    public function getList($params,$admin_id){
        try{            
            $validate = $this->validate($params,true);            
            if ($validate) {                
                //var_dump($params);die();
                $unencodeArray = [];
                $result = null;
                $data = [];
                //Retrieve a list of item paginated by after and before params
                $rows = $this->_model->getList($params);                                            
                //server check if not item found and display response below
                if (!$rows) {
                    $result = [
                        'code' => 200,
                        'items' => [],
                        'total' => 0,
                    ];
                    return $result;
                }
                return $rows;                
            }
            
        }catch(Exception $ex){
            LogRepository::printLog('error', $ex->getMessage());
        }
    }    
    
    public function checkUser($email) {
        try {
            $result = null;            
            $account = new Account();       
            $result = $account::where('email', 'LIKE BINARY', $email)->first();           
            return $result;
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
        }
    }
    
    public function verify($email, $token) {
        try {
            $result = null;            
            $account = new Account();       
            $result = $account::where('email', 'LIKE BINARY', $email)->where('verify_token', '=', $token)->first();           
            return $result;
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
        }
    }

    public function getAccountByID($id){
        try{
            $account = new Account();
            $row = $account::where('id', '=', $id)->first();
            return $row;
        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
    
}
