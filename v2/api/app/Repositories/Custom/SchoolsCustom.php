<?php

namespace App\Repositories\Custom;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Models\School;
use App\Repositories\Custom\CountriesCustom;
use App\Repositories\Custom\CitiesCustom;

class SchoolsCustom {
    
    /*
     * Fields of table Accounts
     */
    protected $_id;
    protected $_name;
    protected $_shortname;
    protected $_logo;
    protected $_address;
    protected $_banner;
    protected $_homelink;
    protected $_location;
    protected $_location_country;
    protected $_location_city;
    protected $_location_lon;
    protected $_location_lat;
    protected $_website;    
    protected $_webtwitter;
    protected $_webyoutube;
    protected $_pagebanner;
    protected $_verify_token;
    protected $_date_created;
    protected $_date_updated;   
    protected $_model;
    protected $_row;
    protected $_countriesCustom;
    protected $_citiesCustom;

    public function __construct($id = null) {
        $this->_model = $this->model();     
        $this->_countriesCustom = new CountriesCustom();
        $this->_citiesCustom = new CitiesCustom();
        if($id){        
            $row = $this->_model->find($id);
            $this->_row = $row;
            if($row){
                $this->_id = $row->id;
                $this->_name = $row->name;
                $this->_shortname = $row->shortname;
                $this->_logo = $row->logo;
                $this->_address = $row->address;
                $this->_description = $row->description;
                $this->_banner = $row->banner;
                $this->_homelink = $row->homelink;
                $this->_location = $row->location;
                $this->_location_country = $row->location_country;
                $this->_location_city = $row->location_city;
                $this->_location_lon = $row->location_lon;
                $this->_location_lat = $row->location_lat;
                $this->_website = $row->website;
                $this->_webfacebook = $row->webfacebook;
                $this->_webyoutube = $row->webyoutube;
                $this->_pagebanner = $row->pagebanner;
                $this->_date_created = $row->date_created;
                $this->_date_updated = $row->date_updated;                    
            }            
        }
        return $this;
    }

    public function model() {
        return new School();
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
                    $school = new School();
                    $row = $school::where('name', '=', $param['name'])->first();                                                                                                
                    if ($row) {                        
                        LogRepository::printLog('error', "Invalid attempt to create a new school with a name taken {".$param['name']."}. Returned code: 400. Request inputs  #" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "name of city already exists");                       
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
                if (array_key_exists('logo', $param)) {
                    if (is_null($param['logo'])) {
                        $result = array("code" => 4000, "description" => "logo is required ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (!is_string($param['logo'])) {
                        $result = array("code" => 4000, "description" => "logo is a string ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    if (empty(trim($param['logo']))) {
                        $result = array("code" => 4000, "description" => "logo must not be empty ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else{
                    throw new Exception("Expected 'logo' in array as parameter , " . (is_object($param['logo']) ? get_class($param['logo']) : gettype($param['logo'])) . " found.");
                }
                if (array_key_exists('address', $param)) {
                    if (!is_null($param['address'])) {
                        if (!is_string($param['address'])) {
                            $result = array("code" => 4000, "description" => "address is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['address']))) {
                            $result = array("code" => 4000, "description" => "address must not be empty ");
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
                if (array_key_exists('banner', $param)) {
                    if (!is_null($param['banner'])) {
                        if (!is_string($param['banner'])) {
                            $result = array("code" => 4000, "description" => "banner is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['banner']))) {
                            $result = array("code" => 4000, "description" => "banner must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                        
                }
                if (array_key_exists('homelink', $param)) {
                    if (!is_null($param['homelink'])) {
                        if (!is_string($param['homelink'])) {
                            $result = array("code" => 4000, "description" => "homelink is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['homelink']))) {
                            $result = array("code" => 4000, "description" => "homelink must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                        
                }
                if (array_key_exists('location', $param)) {
                    if (!is_null($param['location'])) {
                        if (!is_string($param['location'])) {
                            $result = array("code" => 4000, "description" => "location is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['location']))) {
                            $result = array("code" => 4000, "description" => "location must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                    
                }
                if (array_key_exists('location_lon', $param)) {
                    if (!is_null($param['location_lon'])) {
                        if (!is_string($param['location_lon'])) {
                            $result = array("code" => 4000, "description" => "location_lon is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['location_lon']))) {
                            $result = array("code" => 4000, "description" => "location_lon must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                        
                }
                if (array_key_exists('location_lat', $param)) {
                    if (!is_null($param['location_lat'])) {
                        if (!is_string($param['location_lat'])) {
                            $result = array("code" => 4000, "description" => "location_lat is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['location_lat']))) {
                            $result = array("code" => 4000, "description" => "location_lat must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                     
                }
                if (array_key_exists('website', $param)) {
                    if (!is_null($param['website'])) {
                        if (!is_string($param['website'])) {
                            $result = array("code" => 4000, "description" => "website is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['website']))) {
                            $result = array("code" => 4000, "description" => "website must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                        
                }
                if (array_key_exists('webtwitter', $param)) {
                    if (!is_null($param['webtwitter'])) {
                        if (!is_string($param['webtwitter'])) {
                            $result = array("code" => 4000, "description" => "webtwitter is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['webtwitter']))) {
                            $result = array("code" => 4000, "description" => "webtwitter must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                    
                }
                if (array_key_exists('webfacebook', $param)) {
                    if (!is_null($param['webfacebook'])) {
                        if (!is_string($param['webfacebook'])) {
                            $result = array("code" => 4000, "description" => "webfacebook is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['webfacebook']))) {
                            $result = array("code" => 4000, "description" => "webfacebook must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                    
                }
                if (array_key_exists('webyoutube', $param)) {
                    if (!is_null($param['webyoutube'])) {
                        if (!is_string($param['webyoutube'])) {
                            $result = array("code" => 4000, "description" => "webyoutube is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['webyoutube']))) {
                            $result = array("code" => 4000, "description" => "webyoutube must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }
                }
                if (array_key_exists('pagebanner', $param)) {
                    if (!is_null($param['pagebanner'])) {
                        if (!is_string($param['pagebanner'])) {
                            $result = array("code" => 4000, "description" => "pagebanner is a string ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                        if (empty(trim($param['pagebanner']))) {
                            $result = array("code" => 4000, "description" => "pagebanner must not be empty ");
                            echo json_encode($result, JSON_UNESCAPED_SLASHES);
                            return false;
                        }
                    }                                        
                }
                if (array_key_exists('location_country', $param)) {
                    if (!is_numeric($param['location_country'])) {
                        $result = array("code" => 4000, "description" => "country is a number ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    $country = $this->_countriesCustom->getCountryByID($param['location_country']);
                    if(!$country){
                        LogRepository::printLog('error', "Invalid country ID {".$param['location_country']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "Invalid Country ID");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else{
                    throw new Exception("Expected numeric for key (country), " . (is_object($param['location_country']) ? get_class($param['location_country']) : gettype($param['location_country'])) . ' found.');
                }
                if (array_key_exists('location_city', $param)) {
                    if (!is_numeric($param['location_city'])) {
                        $result = array("code" => 4000, "description" => "city is a number ");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }
                    $city = $this->_citiesCustom->getCityByID($param['location_city']);
                    if(!$city){
                        LogRepository::printLog('error', "Invalid city ID {".$param['location_city']."}. Returned code: 400. Request inputs :" . var_export($param,true) . ".");
                        $result = array("code" => 4001, "description" => "Invalid City ID");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        return false;
                    }                    
                }else{
                    throw new Exception("Expected numeric for key (city), " . (is_object($param['location_city']) ? get_class($param['location_city']) : gettype($param['location_city'])) . ' found.');
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
                $school_id = $this->_model->id;
                $result = $this->prepareResponseAfterPost($params,$school_id);
                LogRepository::printLog('info', "The new school #".$school_id." has just been created. Request inputs:  #{" . var_export($params,true) . "}.");
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
                            'href' => "/schools/{$id}",
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

    public function getSchoolByID($id){
        try{
            $school = new School();
            $row = $school::where('id', '=', $id)->first();
            return $row;
        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
    
}
