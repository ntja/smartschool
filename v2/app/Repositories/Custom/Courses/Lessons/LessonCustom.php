<?php

namespace App\Repositories\Custom\Courses\Lessons;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Repositories\Custom\Courses\Course\Sections\LessonsCustom as Lessons;

class LessonCustom {        

	
    public $_lessonCustom;

    public function __construct() {		
        $this->_lessonCustom = new Lessons();
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
			if (!is_numeric($param) && !is_string($param)) {
				$result = array("code" => 4000, "description" => "Invalid object ID");
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				return false;
			}
            return true;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function getLesson($id){
        try{            
            //dd("Here");
            $validate = $this->validate($id);			
            if ($validate) {
				/*
                if(is_numeric($course)){
					$result = $this->_courseCustom->getCourseByID($course);
				}else{
					$result = $this->_courseCustom->getCourseByShortname($course);
				}
				*/
				$lesson = $this->_lessonCustom->model();
				$select = $lesson::with(
					[
						'lesson_material' => function ($query) {
							$query->select('id','type','link','lesson','extension');
						},
						'course_section' => function ($query) {
							$query->select('course_sections.*');
						}
					]);
				if(is_numeric($id)){
					$row = $select->where('course_lessons.id', '=', $id)->select('course_lessons.*')->first();
				}else{
					$row = $select->where('course_lessons.slug_title', 'LIKE', $id)->select('course_lessons.*')->first();
				}
				/*				
				*/
				//var_dump($row->course_section->course);die();
                if($row){					
					LogRepository::printLog('info', "The information of lesson #". $id ." has been retrieved."); 
					return $this->prepareResponseAfterGet($row);
				}else{
					http_response_code(400);
					$result = array("code" => 4000, "description" => "lesson not found");
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
	
	private function prepareResponseAfterGet($row){
		$prev_course = $this->_lessonCustom->model()->where('course_lessons.section', '=', $row->section)->where('course_lessons.id', '=', $row->id-1)->select('course_lessons.*')->first(); //$this->getLesson($row->id-1);
		$next_course = $this->_lessonCustom->model()->where('course_lessons.section', '=', $row->section)->where('course_lessons.id', '=', $row->id+1)->select('course_lessons.*')->first(); //$this->getLesson($row->id+1);
		$row->prev_course = $prev_course;
		$row->next_course = $next_course;
		return $row;
	}
}
