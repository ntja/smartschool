<?php

namespace App\Repositories\Custom;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Models\Book;
use App\Repositories\Custom\Books\CategoriesCustom;

class BooksCustom {
    
    /*
     * Fields of table Accounts
     */
    protected $_id;
    protected $_name;
    protected $_category;
    protected $_size;
    protected $_author;    
    protected $_description;
    protected $_language;
    protected $_cover;
    protected $_filepath;
    protected $_format;
    protected $_date_created;    
    protected $_model;
    protected $_row;
    protected $_categoriesCustom;

    public function __construct($id = null) {
        $this->_model = $this->model();       
        $this->_categoriesCustom = new CategoriesCustom();      
        if($id){        
            $row = $this->_model->find($id);
            $this->_row = $row;
            if($row){
                $this->_id = $row->id;
                $this->_name = $row->name;
                $this->_category = $row->category;
                $this->_language = $row->language;
                $this->_size = $row->size;
                $this->_author = $row->author;
                $this->_description = $row->description;
                $this->_cover = $row->cover;
                $this->_filepath = $row->filepath;
                $this->_format = $row->format;                
                $this->_date_created = $row->date_created;                
            }            
        }
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
    public function validate($param, $get_request=false) {
        try {            
            if (!is_array($param)) {
                throw new Exception("Expected array as parameter , " . (is_object($level) ? get_class($level) : gettype($level)) . " found.");
            }
            
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
                if (array_key_exists('filepath', $param)) {
                    if (is_null($param['filepath'])) {
                        $result = array("code" => 4000, "description" => "filepath is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['filepath'])) {
                        $result = array("code" => 4000, "description" => "filepath is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim($param['filepath']))) {
                        $result = array("code" => 4000, "description" => "filepath must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                                        
                }else{
                    throw new Exception("Expected 'filepath' in array as parameter , " . (is_object($param['filepath']) ? get_class($param['filepath']) : gettype($param['filepath'])) . " found.");
                }                                        
                if (array_key_exists('author', $param)) {
                    if (!is_null($param['author'])) {
                        if (!is_string($param['author'])) {
                            $result = array("code" => 4000, "description" => "author is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['author']))) {
                            $result = array("code" => 4000, "description" => "author must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                        
                }
                if (array_key_exists('size', $param)) {
                    if (!is_null($param['size'])) {
                        if (!is_string($param['size'])) {
                            $result = array("code" => 4000, "description" => "size is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['size']))) {
                            $result = array("code" => 4000, "description" => "size must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                        
                }
                if (array_key_exists('description', $param)) {
                    if (!is_null($param['description'])) {
                        if (!is_string($param['description'])) {
                            $result = array("code" => 4000, "description" => "description is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['description']))) {
                            $result = array("code" => 4000, "description" => "description must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                    
                }                
                if (array_key_exists('language', $param)) {
                    if (!is_null($param['language'])) {
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
                    }                                        
                }
                if (array_key_exists('cover', $param)) {
                    if (!is_null($param['cover'])) {
                        if (!is_string($param['cover'])) {
                            $result = array("code" => 4000, "description" => "cover is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['cover']))) {
                            $result = array("code" => 4000, "description" => "cover must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                     
                }
                if (array_key_exists('format', $param)) {
                    if (!is_null($param['format'])) {
                        if (!is_numeric($param['format'])) {
                            $result = array("code" => 4000, "description" => "format is a string ");
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
                    $category = $this->_categoriesCustom->getCategoryByID($param['category']);
                    if(!$category){
                        LogRepository::printLog('error', "Invalid category ID {".$param['category']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
                        $result = array("code" => 4011, "description" => "Invalid category ID");
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
            $params['date_created'] = date('Y-m-d H:i:s');            
            //var_dump($params);die();
            $saved = $this->_model->dbSave($params);
            if($saved){             
                $course_id = $this->_model->id;
                $result = $this->prepareResponseAfterPost($params,$course_id);
                LogRepository::printLog('info', "The new book #".$course_id." has just been created. Request inputs:  #{" . var_export($params,true) . "}.");
            }else{
                http_response_code(400);
                $result = array("code" => 4000, "description" => "An error occured. Account has not been created");
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
                            'href' => "/books/{$id}",
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

    public function getBookByID($id){
        try{
            $book = new Book();
            $row = $book::where('id', '=', $id)->first();
            return $row;
        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
    public function getBookByName($id){
        try{
            $book = new Book();
            $row = $book::where('name', '=', $name)->first();
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
                $rows = $this->_model->getBooks($params, $account);
				if($rows){
					//LogRepository::printLog('info', "All books have been retrieve by user #".$account->getPropertyValue('id').". Request inputs: {" . var_export($params,true) . "}.");    
					return $rows;
				}else{
					$result = [
                        'code' => 200,
                        'data' => [],
                        'total' => 0,
                    ];
                    return $result;
				}
                
            }            
        }catch(Exception $ex){
            LogRepository::printLog('error', $ex->getMessage());
        }
    }    
}
