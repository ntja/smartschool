<?php

namespace App\Repositories\Custom;

use App\Repositories\Util\LogRepository;
use Exception;
use App\Models\JoinCourse;

class JoinCoursesCustom {
    
    /*
     * Fields of table join_courses
     */
    protected $_account;
    protected $_course;
    protected $_status;    
    protected $_requestedby;
    protected $_date_joined;
    protected $_date_left;
    protected $_model;
    protected $_row;
    
    public function __construct($id = null) {
        $this->_model = $this->model();                
        if($id){        
            $row = $this->_model->find($id);
            $this->_row = $row;
            if($row){
                $this->_account = $row->account;
                $this->_course = $row->course;
                $this->_status = $row->status;
                $this->_requestedby = $row->requestedy;
                $this->_date_joined = $row->date_joined;
                $this->_date_left = $row->date_left;
            }            
        }
        return $this;
    }

    public function model() {
        return new JoinCourse();
    }

    public function getPropertyValue($key){
        $property_name = "_".$key;
        return $this->$property_name;
    }
}
