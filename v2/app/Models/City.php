<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;

class City extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'cities';
    public $timestamps = false;
    protected $fillable = [
        'name','country'
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
        
    public function country(){
        return $this->belongsTo('App\Models\Country');
    }
    public function dbSave($params) {
		//var_dump($params);die();
        try {            
            if (!is_array($params)){
				throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
			}                

            if (array_key_exists("name", $params)) {
                if (!is_string($params['name'])) {
                    throw new Exception("Expected String for key (name), " . (is_object($params['name']) ? get_class($params['name']) : gettype($params['name'])) . ' found.');
                }
                $this->name = $params['name'];
            }

            if (array_key_exists("date_created", $params)) {
                if (!is_string($params['date_created'])) {
                    throw new Exception("Expected String for key (date_created), " . (is_object($params['date_created']) ? get_class($params['date_created']) : gettype($params['date_created'])) . ' found.');
                }
                $this->date_created = $params['date_created'];
            }

            if (array_key_exists("country", $params)) {
                if (!is_string($params['country'])) {
                    throw new Exception("Expected String for key (country), " . (is_object($params['country']) ? get_class($params['country']) : gettype($params['country'])) . ' found.');
                }
                $this->country = $params['country'];
            }            
			//var_dump($params);die();
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }
}