<?php

/* 
 * @author - Jephte Ndongmou, August 2017
 * 
 */

namespace App\Repositories\Custom;

use App\Repositories\Util\LogRepository;
use Exception;
use DB;
use App\Models\Course;
use App\Models\Book;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;

class SearchCustom {
	
    protected $_course;
	protected $_book;
    protected $_row;    

    public function __construct() {
        $this->_course = new Course();
		$this->_book = new Book();
        return $this;
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
    public function validate($param) {
        try {            
            if (!is_array($param)) {
                throw new Exception("Expected array as parameter , " . (is_object($level) ? get_class($level) : gettype($level)) . " found.");
            }            
			if (array_key_exists('query', $param)) {
				if (!is_array($param['query'])) {
					$result = array("code" => 4000, "description" => "query must be an array");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}				
			}  
			//var_dump($param); die("Here");			
            return true;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }
    
    public function search($params){
        try{            
            //dd("Here");
            $validate = $this->validate($params);            
            if ($validate) {                                      
                //Retrieve a list of item paginated by after and before params
                $books = $this->_book->search($params);
				$courses = $this->_course->search($params);
				$data = [];
				/*
				$new_collection = array_merge($books->toArray(), $courses->toArray());
				$new_collection_count = count($new_collection);
				//var_dump($new_collection); die("Here");
				$perPage = 20;
				$currentPage = Input::get('page', 1) - 1;
				$new_collection = array_slice($new_collection, $currentPage * $perPage, $perPage);
				$paginator = new Paginator($new_collection, $new_collection_count, $perPage);
				//$Ads = $paginator->render($new_collection, $new_collection_count, $perPage);
				return $paginator;
				*/
				//var_dump($courses); die("Here");
				if($courses && $books){
					$data['courses'] = $courses;
					$data['books'] = $books;
					return $data;
				}else if($courses){
					$data['courses'] = $courses;
					$data['books'] = [];
					return $data;
                    LogRepository::printLog('info', "user searched  Query :% ".var_export($params['query'], true).' % Number of rows found: '. $books->total());
                    return $courses;
                }else if($books){
					$data['courses'] = [];
					$data['books'] = $books;
					return $data;
				}
				else{
                    LogRepository::printLog('info', "user searched  Query : % ".var_export($params['query'], true).' % Number of rows found: 0');
                    return [
                    'rows'=> 0,
                    'data'=>[],
                    'total'=>0,
                    ];
                }
            }     
            http_response_code(400);
            die();
        }catch(Exception $ex){
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }    
}
