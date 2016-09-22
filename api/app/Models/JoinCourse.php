<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Exception;
use App\Repositories\Util\LogRepository;

class JoinCourse extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'join_courses';
    public $timestamps = false;
    protected $fillable = [
        'account','course','date_requested','date_joined','date_left','status','requestedby'
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
            
    public function dbSave($params) {
		//var_dump($params);die();
        try {            
            if (!is_array($params)){
				throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
			}                

            if (array_key_exists("account", $params)) {
                //throw new Exception("Expected key (account) in parameter array.");
                if (!is_numeric($params['account'])) {
                    throw new Exception("Expected Numeric for key (account), " . (is_object($params['account']) ? get_class($params['account']) : gettype($params['account'])) . ' found.');
                }
                $this->account = $params['account'];
            }

            if (array_key_exists("course", $params)) {
                //throw new Exception("Expected key (course) in parameter array.");
                if (!is_numeric($params['course'])) {
                    throw new Exception("Expected Numeric for key (course), " . (is_object($params['course']) ? get_class($params['course']) : gettype($params['course'])) . ' found.');
                }
                $this->course = $params['course'];
            }

            if (array_key_exists("status", $params)) {
                //throw new Exception("Expected key (status) in parameter array.");
                if (!is_string($params['status'])) {
                    throw new Exception("Expected String for key (status), " . (is_object($params['status']) ? get_class($params['status']) : gettype($params['status'])) . ' found.');
                }
                $this->status = $params['status'];
            }

            if (array_key_exists("requestedby", $params)) {
                //throw new Exception("Expected key (requestedby) in parameter array.");
                if (!is_string($params['requestedby'])) {
                    throw new Exception("Expected String for key (requestedby), " . (is_object($params['requestedby']) ? get_class($params['requestedby']) : gettype($params['requestedby'])) . ' found.');
                }
                $this->requestedby = $params['requestedby'];
            }

            if (array_key_exists("date_joined", $params)) {
                //throw new Exception("Expected key (date_joined) in parameter array.");
                if (!is_null($params['date_joined'])) {
                    if (!is_string($params['date_joined'])) {
                        throw new Exception("Expected String for key (date_joined), " . (is_object($params['date_joined']) ? get_class($params['date_joined']) : gettype($params['date_joined'])) . ' found.');
                    }                    
                }    
                $this->date_joined = $params['date_joined'];            
            }

            if (array_key_exists("date_left", $params)) {
                //throw new Exception("Expected key (date_left) in parameter array.");
                if (!is_null($params['date_left'])) {
                    if (!is_string($params['date_left'])) {
                        throw new Exception("Expected String for key (date_left), " . (is_object($params['date_left']) ? get_class($params['date_left']) : gettype($params['date_left'])) . ' found.');
                    }                    
                }    
                $this->date_left = $params['date_left'];            
            }

            if (array_key_exists("date_requested", $params)) {
                //throw new Exception("Expected key (date_requested) in parameter array.");
                if (!is_string($params['date_requested'])) {
                    throw new Exception("Expected String for key (date_requested), " . (is_object($params['date_requested']) ? get_class($params['date_requested']) : gettype($params['date_requested'])) . ' found.');
                }
                $this->date_requested = $params['date_requested'];
            }            
						
			//var_dump($params);die();			
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
}