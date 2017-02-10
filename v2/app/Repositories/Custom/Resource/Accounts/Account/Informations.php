<?php
namespace App\Repositories\Custom\Resource\Accounts\Account;

class Informations {
    public $id;
    public function __construct($id = null) {
    	if($id){
    		$this->id = $id;
    	}        
        return $this;        
    }
}

