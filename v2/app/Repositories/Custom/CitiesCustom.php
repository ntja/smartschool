<?php

namespace App\Repositories\Custom;

use App\Repositories\Util\LogRepository;
use Exception;
//use Validator;
use App\Models\City;
use App\Repositories\Custom\CountriesCustom;

class CitiesCustom {

    
    /*
     * Fields of table Countries
     */
    protected $_id;
    protected $_name;
    protected $_country;    
    protected $_date_created;
    protected $_model;
    protected $_row;
    protected $_countriesCustom;
    
    public function __construct($id = null) {
        $this->_model = $this->model();
        $this->_countriesCustom = new CountriesCustom();
        if($id){        
            $row = $this->_model->find($id);
            $this->_row = $row;
            if($row){
                $this->_id = $row->id;
                $this->_name = $row->name;
                $this->_country = $row->country;
                $this->_date_created = $row->date_created;                
            }            
        }
        return $this;
    }

    public function model() {
        return new City();
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
                    $city = new City();
                    $name = $city::where('name', '=', $param['name'])->first();                                                                                                
                    if ($name) {                        
                        LogRepository::printLog('error', "Invalid attempt to create a new city with a name taken {".$param['name']."}. Returned code: 400. Request inputs  #" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "name of city already exists");                       
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                }else{
                throw new Exception("Expected 'name' in array as parameter , " . (is_object($param['name']) ? get_class($param['name']) : gettype($param['name'])) . " found.");
                }

                if (array_key_exists('country', $param)) {
                    if (!is_numeric($param['country'])) {
                        $result = array("code" => 4000, "description" => "country is a number ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    $country = $this->_countriesCustom->getCountryByID($param['country']);
                    if(!$country){
                        LogRepository::printLog('error', "Invalid country ID {".$param['country']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "Invalid Country ID");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else{
                    throw new Exception("Expected numeric for key (country), " . (is_object($param['country']) ? get_class($param['country']) : gettype($param['country'])) . ' found.');
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
                $city_id = $this->_model->id;                
                $result = $this->prepareResponseAfterPost($params,$city_id);                
                LogRepository::printLog('info', "The new city #".$city_id." has just been created. Request inputs:  #{" . var_export($params,true) . "}.");
            }else{
                http_response_code(400);
                $result = array("code" => 4000, "description" => "An error occured. City has not been created");
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
                            'href' => "/cities/{$id}",
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
        

    public function getCityByID($id){
        try{
            $city = new City();
            $row = $city::where('id', '=', $id)->first();
            return $row;
        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
    
}
