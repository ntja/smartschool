<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;

class Answer extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'answers';
    public $timestamps = false;
    protected $fillable = [
        'content','question','learner','instructor'
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
        
    public function question(){
        return $this->belongsTo('App\Models\Question');
    }
    public function dbSave($params) {
		//var_dump($params);die();
        try {            
            if (!is_array($params)){
				throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
			}                

            if (array_key_exists("content", $params)) {
                if (!is_string($params['content'])) {
                    throw new Exception("Expected String for key (content), " . (is_object($params['content']) ? get_class($params['content']) : gettype($params['content'])) . ' found.');
                }
                $this->content = $params['content'];
            }

            if (array_key_exists("question", $params)) {
                if (!is_numeric($params['question'])) {
                    throw new Exception("Expected number for key (question), " . (is_object($params['question']) ? get_class($params['question']) : gettype($params['question'])) . ' found.');
                }
                $this->question = $params['question'];
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
					$this->instructor = $params['instructor'];
				}
                
            }           
			//var_dump($params);die();
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
}