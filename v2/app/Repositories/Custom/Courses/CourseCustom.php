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
     * Check fields that are allowed to edit
     *
     * @param Array($mixed) $params - list of fields and their respectivves values      
     * @return Boolean True or false
     */
	public function checkNotAllowedFields(Array $param) {
        $allowed_fields = [
            'name','shortname','language','largeicon','photo','shortdescription','smallicon','smalliconhover','istranslate','aboutthecourse','targetaudience','faq','coursesyllabus','courseformat','suggestedreadings','estimatedclassworkload','recommendedbackground','school','category'
        ];
        $found = false;
        foreach ($param as $key => $value) {            
            if (!in_array($key, $allowed_fields)) {
                $found = true;
                break;
            }
        }
        return $found;
    }
	
    /**
     * Validate
     *
     * @param Array($mixed) $param Associative array of parameter 
     * @param Bolean $get_request bolean parameter to check if the request is POST or GET in order to perform validation     
     * @return Array(mixed) The result informations
     */
    public function validate($param, $method="get") {
        try {     
			if($method=="get"){
				if (!is_numeric($param) && !is_string($param)) {
				$result = array("code" => 4000, "description" => "Invalid object ID");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
			}
			if($method=="put"){
				//check if all field are allowed to be edited
				if ($this->checkNotAllowedFields($param)) {
                	 $result = array("code" => 4000, "description" => "There are some field(s) that you are not allowed to edit");
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    return false;
                }
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
				//var_dump($this->_courseCustom->validate($params));die();
			}
            return true;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function getCourse($course){
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
	public function updateCourse($informations, $id){
        try{
        	$valid = $this->validate($informations, 'put');            
            if(!$valid){
                http_response_code(400);
                die(); 
            }
			//var_dump($id);die();
            // Get the user account with its ID
            $course = $this->_courseCustom->model()->find($id);
            if (!is_null($course)) {                   	         
                //var_dump($course);die();
                $course->dbSave($informations);
                // Write in the log
                LogRepository::printLog('info', "Information of course #{" . $id . "} has just been updated. Request inputs: ".var_export($informations,true));
                //  prepare the response
                $result = $this->prepareReponseAfterPut($course);
                //  Return response
                return $result;
            } else {
                LogRepository::printLog('error', "Invalid attempt to update a non existing course #{" . $id . "}. Returned code: 4006. Request inputs:".var_export($informations,true));
                $result = array("code" => 4007, "description" => "Invalid object ID");
                return response()->json($result, 400);
            }
        }catch(Exception $e){
			LogRepository::printLog('error', $e->getMessage());
		}       
    }
	/**
     * Format of the response
     * 
     * @param array $account
     * @return array
     */

    public function prepareReponseAfterPut($course) {
        try {            
            $result = array(
                'code' => 200,
                'account_id' => $course->id,                
            );
            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
}
