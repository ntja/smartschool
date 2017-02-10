<?php

namespace App\Repositories\Custom\Resource\Accounts\Account;

/**
 * Description of Update password
 *
 * @author Jephte
 */
class Password {
    //put your code here
    public $id;

    public function __construct($id=null) {
        if($id){
        	$this->id = $id;
        }
        return $this;
    }
}
