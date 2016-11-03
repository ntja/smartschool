<?php

namespace App\Repositories\Custom\Books;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Models\BookCategory;

class CategoriesCustom {

    
    /*
     * Fields of table Course_categories
     */
    protected $_id;
    protected $_name;   
    protected $_date_created;
    protected $_model;
    protected $_row;
    
    public function __construct($id = null) {
        $this->_model = $this->model();     
        if($id){        
            $row = $this->_model->find($id);
            $this->_row = $row;
            if($row){
                $this->_id = $row->id;
                $this->_name = $row->name;                
                $this->_date_created = $row->date_created;                
            }            
        }

        return $this;
    }

    public function model() {
        return new BookCategory();
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
                    if (empty(trim(($param['name'])))) {
                        $result = array("code" => 4000, "description" => "name must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    $account = new BookCategory();
                    $name = $account::where('name', 'LIKE', $param['name'])->first();                                                                                                
                    if ($name) {                        
                        LogRepository::printLog('error', "Invalid attempt to create a new book category with a name taken {".$param['name']."}. Returned code: 400. Request inputs  #" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "name of category already exists");                       

                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                }else{
                throw new Exception("Expected 'name' in array as parameter , " . (is_object($param['name']) ? get_class($param['name']) : gettype($param['name'])) . " found.");
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
            $saved = $this->_model->dbSave($params);
            if($saved){             
                $category_id = $this->_model->id;                
                $result = $this->prepareResponseAfterPost($params,$category_id);                
                LogRepository::printLog('info', "The new category #".$category_id." has just been created. Request inputs:  #{" . var_export($params,true) . "}.");
            }else{
                http_response_code(400);
                $result = array("code" => 4000, "description" => "An error occured. Course category has not been created");
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
                            'href' => "/books/categories/{$id}",
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
        

    public function getcategoryByID($id){
        try{
            $category = new BookCategory();
            $row = $category::where('id', '=', $id)->first();
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
                $rows = $this->_model->getCategories($params);  
                if($rows){
                    LogRepository::printLog('info', "All books categories has been retrieve by user #".$account->getPropertyValue('id').". Request inputs: {" . var_export($params,true) . "}."); 
                }                
                return $rows;
            }            
        }catch(Exception $ex){
            LogRepository::printLog('error', $ex->getMessage());
        }
    } 
    
}
