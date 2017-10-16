<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;

class Tag extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'tags';
    public $timestamps = false;
    protected $fillable = [
        'name', 'is_active'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'delete_status'
    ];

    public function __construct() {           
        return $this;
    }
	
	/**
     * The questions that belong to the tags.
     */
    public function questions(){
        //return $this->belongsToMany('App\Models\Question');
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
			if (array_key_exists("is_active", $params)) {
                if (!is_string($params['is_active'])) {
                    throw new Exception("Expected numeric for key (is_active), " . (is_object($params['is_active']) ? get_class($params['is_active']) : gettype($params['is_active'])) . ' found.');
                }
                $this->is_active = $params['is_active'];
            }
			//var_dump($params);die();
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
			die();
        }
    }
}