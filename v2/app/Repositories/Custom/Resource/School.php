<?php

namespace App\Repositories\Custom\Resource;

class School {

    public $id;

    public function __construct($id=null) {
    	if($id){
    		$this->id = $id;
    	}
        return $this;
    }

}
