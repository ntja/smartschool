<?php

namespace App\Repositories\Custom\Resource;

class City {

    public $id;

    public function __construct($id=null) {
    	if($id){
    		$this->id = $id;
    	}
        return $this;
    }

}
