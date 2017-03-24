<?php

namespace App\Repositories\Custom\Resource;

class Answer {

    public $id;

    public function __construct($id=null) {
    	if($id){
    		$this->id = $id;
    	}
        return $this;
    }

}
