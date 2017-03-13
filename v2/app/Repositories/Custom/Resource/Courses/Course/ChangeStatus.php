<?php
namespace App\Repositories\Custom\Resource\Courses\Course;

class ChangeStatus {
    public $id;
    public function __construct($id = null) {
    	if($id){
    		$this->id = $id;
    	}        
        return $this;        
    }
}

