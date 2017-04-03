<?php

namespace App\Repositories\Custom;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Models\Course;
//use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\SchoolsCustom;
use App\Repositories\Custom\Courses\CategoriesCustom;

class CoursesCustom {
    
    /*
     * Fields of table Accounts
     */
    protected $_id;
    protected $_name;
    protected $_shortname;
    protected $_language;
    protected $_largeicon;
    protected $_photo;
    protected $_previewlink;
    protected $_location;
    protected $_shortdescription;
    protected $_start_date;
    protected $_smallicon;
    protected $_smalliconhover;
    protected $_istranslate;
    protected $_directorypath;    
    protected $_aboutthecourse;
    protected $_targetaudience;
    protected $_faq;
    protected $_coursesyllabus;
    protected $_courseformat;
    protected $_suggestedreadings;
    protected $_estimatedclassworkload;
    protected $_recommendedbackground;
    protected $_instructor;
    protected $_school;
    protected $_category;
    protected $_date_created;
    protected $_date_updated;   
    protected $_model;
    protected $_row;
    //protected $_accountsCustom;
    protected $_schoolsCustom;
    protected $_categoriesCustom;

    public function __construct($id = null) {
        $this->_model = $this->model();     
        //$this->_accountsCustom = new AccountsCustom();
        $this->_schoolsCustom = new SchoolsCustom();
        $this->_categoriesCustom = new CategoriesCustom();
        
        if($id){        
            $row = $this->_model->find($id);
            $this->_row = $row;
            if($row){
                $this->_id = $row->id;
                $this->_name = $row->name;
                $this->_shortname = $row->shortname;
                $this->_language = $row->language;
                $this->_largeicon = $row->largeicon;
                $this->_photo = $row->photo;
                $this->_previewlink = $row->previewlink;
                $this->_shortdescription = $row->shortdescription;
                $this->_start_date = $row->start_date;
                $this->_smallicon = $row->smallicon;
                $this->_smalliconhover = $row->smalliconhover;
                $this->_istranslate = $row->istranslate;
                $this->_directorypath = $row->directorypath;
                $this->_aboutthecourse = $row->aboutthecourse;
                $this->_targetaudience = $row->targetaudience;
                $this->_faq = $row->faq;
                $this->_coursesyllabus = $row->coursesyllabus;
                $this->_courseformat = $row->courseformat;
                $this->_suggestedreadings = $row->suggestedreadings;
                $this->_estimatedclassworkload = $row->estimatedclassworkload;
                $this->_recommendedbackground = $row->recommendedbackground;
                $this->_instructor = $row->instructor;
                $this->_school = $row->school;
                $this->_category = $row->category;
                $this->_date_created = $row->date_created;
                $this->_date_updated = $row->date_updated;                    
            }            
        }
        return $this;
    }

    public function model() {
        return new Course();
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
                throw new Exception("Expected array as parameter , " . (is_object($param) ? get_class($param) : gettype($param)) . " found.");
            }
            //var_dump($param);die('here');
            if(!$get_request){				
                if (array_key_exists('name', $param)) {
                    if (is_null($param['name'])) {
                        $result = array("code" => 4000, "description" => "name is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['name'])) {
                        $result = array("code" => 4000, "description" => "name is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim($param['name']))) {
                        $result = array("code" => 4000, "description" => "name must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else{
                    throw new Exception("Expected 'name' in array as parameter , " . (is_object($param['name']) ? get_class($param['name']) : gettype($param['name'])) . " found.");
                }
                if (array_key_exists('shortname', $param)) {
                    if (is_null($param['shortname'])) {
                        $result = array("code" => 4000, "description" => "shortname is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['shortname'])) {
                        $result = array("code" => 4000, "description" => "shortname is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim($param['shortname']))) {
                        $result = array("code" => 4000, "description" => "shortname must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else{
                    throw new Exception("Expected 'shortname' in array as parameter , " . (is_object($param['shortname']) ? get_class($param['shortname']) : gettype($param['shortname'])) . " found.");
                }
                if (array_key_exists('language', $param)) {
                    if (is_null($param['language'])) {
                        $result = array("code" => 4000, "description" => "language is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['language'])) {
                        $result = array("code" => 4000, "description" => "language is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim($param['language']))) {
                        $result = array("code" => 4000, "description" => "language must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else{
                    throw new Exception("Expected 'language' in array as parameter , " . (is_object($param['language']) ? get_class($param['language']) : gettype($param['language'])) . " found.");
                }
                if (array_key_exists('shortdescription', $param)) {
                    if (is_null($param['shortdescription'])) {
                        $result = array("code" => 4000, "description" => "shortdescription is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['shortdescription'])) {
                        $result = array("code" => 4000, "description" => "shortdescription is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim($param['shortdescription']))) {
                        $result = array("code" => 4000, "description" => "shortdescription must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else{
                    throw new Exception("Expected 'shortdescription' in array as parameter , " . (is_object($param['shortdescription']) ? get_class($param['shortdescription']) : gettype($param['shortdescription'])) . " found.");
                }
                if (array_key_exists('largeicon', $param)) {
                    if (!is_null($param['largeicon'])) {
                        if (!is_string($param['largeicon'])) {
                            $result = array("code" => 4000, "description" => "largeicon is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['largeicon']))) {
                            $result = array("code" => 4000, "description" => "largeicon must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                    
                }
                if (array_key_exists('photo', $param)) {
                    if (!is_null($param['photo'])) {
                        if (!is_string($param['photo'])) {
                            $result = array("code" => 4000, "description" => "photo is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['photo']))) {
                            $result = array("code" => 4000, "description" => "photo must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                    
                }
                if (array_key_exists('start_date', $param)) {
                    if (!is_null($param['start_date'])) {
                        if (!is_string($param['start_date'])) {
                            $result = array("code" => 4000, "description" => "start_date is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['start_date']))) {
                            $result = array("code" => 4000, "description" => "start_date must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                    
                }
                if (array_key_exists('previewlink', $param)) {
                    if (!is_null($param['previewlink'])) {
                        if (!is_string($param['previewlink'])) {
                            $result = array("code" => 4000, "description" => "previewlink is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['previewlink']))) {
                            $result = array("code" => 4000, "description" => "previewlink must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                        
                }
                if (array_key_exists('smallicon', $param)) {
                    if (!is_null($param['smallicon'])) {
                        if (!is_string($param['smallicon'])) {
                            $result = array("code" => 4000, "description" => "smallicon is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['smallicon']))) {
                            $result = array("code" => 4000, "description" => "smallicon must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                        
                }
                if (array_key_exists('smalliconhover', $param)) {
                    if (!is_null($param['smalliconhover'])) {
                        if (!is_string($param['smalliconhover'])) {
                            $result = array("code" => 4000, "description" => "smalliconhover is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['smalliconhover']))) {
                            $result = array("code" => 4000, "description" => "smalliconhover must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                    
                }
                if (array_key_exists('istranslate', $param)) {
                    if (is_null($param['istranslate'])) {
                        $result = array("code" => 4000, "description" => "istranslate is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_numeric($param['istranslate'])) {
                        $result = array("code" => 4000, "description" => "istranslate is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                                    
                }
                if (array_key_exists('directorypath', $param)) {
                    if (!is_null($param['directorypath'])) {
                        if (!is_string($param['directorypath'])) {
                            $result = array("code" => 4000, "description" => "directorypath is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['directorypath']))) {
                            $result = array("code" => 4000, "description" => "directorypath must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                        
                }
                if (array_key_exists('aboutthecourse', $param)) {
                    if (!is_null($param['aboutthecourse'])) {
                        if (!is_string($param['aboutthecourse'])) {
                            $result = array("code" => 4000, "description" => "aboutthecourse is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['aboutthecourse']))) {
                            $result = array("code" => 4000, "description" => "aboutthecourse must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                     
                }
                if (array_key_exists('targetaudience', $param)) {
                    if (!is_null($param['targetaudience'])) {
                        if (!is_numeric($param['targetaudience'])) {
                            $result = array("code" => 4000, "description" => "targetaudience is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }                        
                    }                                        
                }
                if (array_key_exists('faq', $param)) {
                    if (!is_null($param['faq'])) {
                        if (!is_string($param['faq'])) {
                            $result = array("code" => 4000, "description" => "faq is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['faq']))) {
                            $result = array("code" => 4000, "description" => "faq must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                    
                }
                if (array_key_exists('coursesyllabus', $param)) {
                    if (!is_null($param['coursesyllabus'])) {
                        if (!is_string($param['coursesyllabus'])) {
                            $result = array("code" => 4000, "description" => "coursesyllabus is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['coursesyllabus']))) {
                            $result = array("code" => 4000, "description" => "coursesyllabus must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                    
                }
                if (array_key_exists('courseformat', $param)) {
                    if (!is_null($param['courseformat'])) {
                        if (!is_string($param['courseformat'])) {
                            $result = array("code" => 4000, "description" => "courseformat is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['courseformat']))) {
                            $result = array("code" => 4000, "description" => "courseformat must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }
                }
                if (array_key_exists('suggestedreadings', $param)) {
                    if (!is_null($param['suggestedreadings'])) {
                        if (!is_string($param['suggestedreadings'])) {
                            $result = array("code" => 4000, "description" => "suggestedreadings is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['suggestedreadings']))) {
                            $result = array("code" => 4000, "description" => "suggestedreadings must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                        
                }
                if (array_key_exists('estimatedclassworkload', $param)) {
                    if (!is_null($param['estimatedclassworkload'])) {
                        if (!is_string($param['estimatedclassworkload'])) {
                            $result = array("code" => 4000, "description" => "estimatedclassworkload is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['estimatedclassworkload']))) {
                            $result = array("code" => 4000, "description" => "estimatedclassworkload must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }
                }
                if (array_key_exists('recommendedbackground', $param)) {
                    if (!is_null($param['recommendedbackground'])) {
                        if (!is_string($param['recommendedbackground'])) {
                            $result = array("code" => 4000, "description" => "recommendedbackground is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['recommendedbackground']))) {
                            $result = array("code" => 4000, "description" => "recommendedbackground must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }
                }
                if (array_key_exists('instructor', $param)) {
                    if (is_null($param['instructor'])) {
                        $result = array("code" => 4000, "description" => "instructor is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_numeric($param['instructor'])) {
                        $result = array("code" => 4000, "description" => "instructor is a number ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                                    
                }else{
                    throw new Exception("Expected 'instructor' in array as parameter , " . (is_object($param['instructor']) ? get_class($param['instructor']) : gettype($param['instructor'])) . " found.");
                }
                if (array_key_exists('school', $param)) {
                    if (!is_null($param['school'])) {
                        if (!is_numeric($param['school'])) {
                            $result = array("code" => 4000, "description" => "school is a number ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }                        
                    }                                        
                }
                if (array_key_exists('category', $param)) {
                    if (!is_numeric($param['category'])) {
                        $result = array("code" => 4000, "description" => "category is a number ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                                        
                }else{
                    throw new Exception("Expected numeric for key (category), " . (is_object($param['category']) ? get_class($param['category']) : gettype($param['category'])) . ' found.');
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
			// verify if school exists
			if (!is_null($param['school'])) {				
				$school = $this->_schoolsCustom->getSchoolByID($param['school']);
				if(!$school){
					LogRepository::printLog('error', "Invalid school ID {".$param['school']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
					$result = array("code" => 4001, "description" => "Invalid school ID");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					http_response_code(400);
					die(); 
				}
			}
			// check if course is unique for a given instructor
			$row = $this->uniqueCourse($param['name'],$param['instructor']);
			if($row){
				LogRepository::printLog('error', "Invalid attempt for an instructor to create a new course with a duplicate name {".$param['name']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
				$result = array("code" => 4012, "description" => "You already have a course with that name");
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				http_response_code(400);
				die();
			}
			// Check if category exists
			$category = $this->_categoriesCustom->getCategoryByID($param['category']);
			if(!$category){
				LogRepository::printLog('error', "Invalid category ID {".$param['category']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
				$result = array("code" => 4011, "description" => "Invalid category ID");
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				http_response_code(400);
				die();
			}
			$row = $this->getCourseByShortname($param['shortname']);
			if($row){
				LogRepository::printLog('error', "Invalid attempt  to create a new course with a taken shortname {".$param['shortname']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
				$result = array("code" => 4001, "description" => "This shortname is already taken");
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				http_response_code(400);
				die();
			}
            $params['date_created'] = date('Y-m-d H:i:s');            
            
			// save course
            $saved = $this->_model->dbSave($params);
            if($saved){             
                $course_id = $this->_model->id;
                $result = $this->prepareResponseAfterPost($params,$course_id);
                LogRepository::printLog('info', "The new course #".$course_id." has just been created. Request inputs:  #{" . var_export($params,true) . "}.");
            }else{
                http_response_code(400);
                $result = array("code" => 4000, "description" => "An error occured. Your course has not been created");
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
                            'href' => "/courses/{$id}",
                            'rel' => 'retrieve',
                            'requestTypes' => array("GET"),
                            'responseTypes' => array("application/json")
                        ],
                         [
                            'href' => "/courses/{$id}/lessons",
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

    public function getCourseByID($id){
        try{
            $course = $this->model();
            $row = $course::with(['account'=> function ($query) {
					$query->select('id','first_name','last_name');
				},'courseCategory','section'])->where('id', '=', $id)->first();
            return $row;
        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function getCourseByShortname($short_name){
        try{
            $course = $this->model();
			$row = $course::with(['account'=> function ($query) {
					$query->select('id','first_name','last_name');
				},'courseCategory','section'])->where('courses.shortname', '=', $short_name)->first();
			/*
            $row = $course::join('accounts', 'accounts.id', '=', 'courses.instructor')
                ->join('course_categories', 'course_categories.id', '=', 'courses.category')
                ->where('courses.shortname', '=', $id)
                ->select('courses.*', 'course_categories.name as category_name','accounts.first_name','accounts.last_name')->first();
            //$row = $course::where('shortname', '=', $id)->first();
			*/
            return $row;
        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function uniqueCourse($course_name, $instructor){
        try{
            $course = $this->model();
            $row = $course::where('instructor', '=', $instructor)
                            ->where('name','LIKE',$course_name)->first();
            return $row;
        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function getList($params,$account){
        try{            
            //dd("Here");
            $validate = $this->validate($params,true);            
            if ($validate) {                         
                //Retrieve a list of item paginated by after and before params
				
                $rows = $this->_model->getCourses($params, $account);
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
            LogRepository::printLog('error', $ex->getMessage());
        }
    }    
}
