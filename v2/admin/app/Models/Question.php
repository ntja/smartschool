<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;

class Question extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'questions';
    public $timestamps = false;
    protected $fillable = [
        'title','description','is_visible','learner','instructor'
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
        
    public function answer(){
        return $this->hasMany('App\Models\Answer');
    }
	
	/**
     * The tags that belong to the question.
     */
    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }
	
	// Persist the data
    public function dbSave($params) {
		//var_dump($params);die();
        try {            
            if (!is_array($params)){
				throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
			}                

            if (array_key_exists("title", $params)) {
                if (!is_string($params['title'])) {
                    throw new Exception("Expected String for key (title), " . (is_object($params['title']) ? get_class($params['title']) : gettype($params['title'])) . ' found.');
                }
                $this->title = $params['title'];
            }
			if (array_key_exists("description", $params)) {
                if (!is_string($params['description'])) {
                    throw new Exception("Expected String for key (description), " . (is_object($params['description']) ? get_class($params['description']) : gettype($params['description'])) . ' found.');
                }
                $this->description = $params['description'];
            }
			
			if (array_key_exists("is_visible", $params)) {
                if (!is_numeric($params['is_visible'])) {
                    throw new Exception("Expected number for key (is_visible), " . (is_object($params['is_visible']) ? get_class($params['is_visible']) : gettype($params['is_visible'])) . ' found.');
                }
                $this->is_visible = $params['is_visible'];
            }

            if (array_key_exists("learner", $params)) {
				if (!is_null($params['learner'])) {
					if (!is_numeric($params['learner'])) {
						throw new Exception("Expected number for key (learner), " . (is_object($params['learner']) ? get_class($params['learner']) : gettype($params['learner'])) . ' found.');
					}
					$this->learner = $params['learner'];
				}
                
            }

            if (array_key_exists("instructor", $params)) {
				if (!is_null($params['instructor'])) {
					if (!is_numeric($params['instructor'])) {
						throw new Exception("Expected number for key (instructor), " . (is_object($params['instructor']) ? get_class($params['instructor']) : gettype($params['instructor'])) . ' found.');
					}
				}
                
                $this->instructor = $params['instructor'];
            }            
			//var_dump($params); die();
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
}