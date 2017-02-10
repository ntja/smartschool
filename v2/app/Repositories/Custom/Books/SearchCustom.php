<?php

/* 
 * @author - Jephte Ndongmou, Nov 2016
 * 
 */

namespace App\Repositories\Custom\Books;

use App\Repositories\Util\LogRepository;
use Exception;
use DB;
use App\Models\Book;

class SearchCustom {
        
    protected $_model;
    protected $_row;    

    public function __construct() {
        $this->_model = $this->model();                    
        return $this;
    }

    public function model() {
        return new Book();
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
				if (!is_string($param['query'])) {
					$result = array("code" => 4000, "description" => "query must be a string ");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
				if (empty(trim($param['query']))) {
					$result = array("code" => 4000, "description" => "query must not be empty ");
					echo json_encode($result, JSON_UNESCAPED_SLASHES);
					return false;
				}
			}               
			//var_dump($param); die("Here");			
            return true;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
    
   public function search($params){
        try{            
            //dd("Here");
            $validate = $this->validate($params);            
            if ($validate) {                                      
                //Retrieve a list of item paginated by after and before params
                $rows = $this->_model->search($params);                                         
                if($rows){                    
                    LogRepository::printLog('info', "user searched Books. Query :% ".$params['query'].' % Number of rows found: '. $rows->total());
                    return $rows;
                }else{
                    LogRepository::printLog('info', "user searched Books. Query : % ".$params['query'].' % Number of rows found: 0');
                    return [
                    'rows'=> 0,
                    'data'=>null,
                    'total'=>0,
                    ];
                }
            }     
            http_response_code(400);       
            die();
        }catch(Exception $ex){
            LogRepository::printLog('error', $ex->getMessage());
        }
    }   
}
