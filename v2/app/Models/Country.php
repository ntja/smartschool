<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;

class Country extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'countries';
    public $timestamps = false;
    protected $fillable = [
        'name','is_active','shortname'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function __construct() {           
        return $this;
    }
        
    public function city(){
        return $this->hasMany('App\Models\City','country');
    }

    public function dbSave($params) {
		//var_dump($params);die();
        try {            
            if (!is_array($params)){
				throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
			}                

            if (array_key_exists("name", $params)) {
                //throw new Exception("Expected key (name) in parameter array.");
                if (!is_string($params['name'])) {
                    throw new Exception("Expected String for key (name), " . (is_object($params['name']) ? get_class($params['name']) : gettype($params['name'])) . ' found.');
                }
                $this->name = $params['name'];
            }
            if (array_key_exists("shortname", $params)) {
                //throw new Exception("Expected key (shortname) in parameter array.");
                if (!is_null($params['shortname'])) {
                    if (!is_string($params['shortname'])) {
                        throw new Exception("Expected String for key (shortname), " . (is_object($params['shortname']) ? get_class($params['shortname']) : gettype($params['shortname'])) . ' found.');
                    }
                }                
                $this->shortname = $params['shortname'];
            }            
			
			if (array_key_exists("is_active", $params)) {				
				$this->is_active = $params['is_active'];
            }
            if (array_key_exists("date_created", $params)) {
                //throw new Exception("Expected key (date_created) in parameter array.");
                if (!is_string($params['date_created'])) {
                    throw new Exception("Expected String for key (date_created), " . (is_object($params['date_created']) ? get_class($params['date_created']) : gettype($params['date_created'])) . ' found.');
                }
                $this->date_created = $params['date_created'];
            }
			//var_dump($params);
			//die();
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }
}