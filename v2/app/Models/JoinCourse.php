<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;
use Exception;
use App\Repositories\Util\LogRepository;
use DB;

class JoinCourse extends Pivot{
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
        'delete_status',
    ];
	
	public function account() {
        return $this->belongsTo('App\Models\Account', 'account');
    }
	
    public function course_details() {
        return $this->belongsTo('App\Models\Course', 'course');
    }
	
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
                if (!is_numeric($params['account'])) {
                    throw new Exception("Expected Numeric for key (account), " . (is_object($params['account']) ? get_class($params['account']) : gettype($params['account'])) . ' found.');
                }
                $this->account = $params['account'];
            }

            if (array_key_exists("course", $params)) {
                if (!is_numeric($params['course'])) {
                    throw new Exception("Expected Numeric for key (course), " . (is_object($params['course']) ? get_class($params['course']) : gettype($params['course'])) . ' found.');
                }
                $this->course = $params['course'];
            }

            if (array_key_exists("status", $params)) {
                if (!is_string($params['status'])) {
                    throw new Exception("Expected String for key (status), " . (is_object($params['status']) ? get_class($params['status']) : gettype($params['status'])) . ' found.');
                }
                $this->status = $params['status'];
            }

            if (array_key_exists("requestedby", $params)) {
                if (!is_string($params['requestedby'])) {
                    throw new Exception("Expected String for key (requestedby), " . (is_object($params['requestedby']) ? get_class($params['requestedby']) : gettype($params['requestedby'])) . ' found.');
                }
                $this->requestedby = $params['requestedby'];
            }

            if (array_key_exists("date_joined", $params)) {
                if (!is_null($params['date_joined'])) {
                    if (!is_string($params['date_joined'])) {
                        throw new Exception("Expected String for key (date_joined), " . (is_object($params['date_joined']) ? get_class($params['date_joined']) : gettype($params['date_joined'])) . ' found.');
                    }                    
                }    
                $this->date_joined = $params['date_joined'];            
            }

            if (array_key_exists("date_left", $params)) {
                if (!is_null($params['date_left'])) {
                    if (!is_string($params['date_left'])) {
                        throw new Exception("Expected String for key (date_left), " . (is_object($params['date_left']) ? get_class($params['date_left']) : gettype($params['date_left'])) . ' found.');
                    }                    
                }    
                $this->date_left = $params['date_left'];            
            }

            if (array_key_exists("date_requested", $params)) {
                if (!is_string($params['date_requested'])) {
                    throw new Exception("Expected String for key (date_requested), " . (is_object($params['date_requested']) ? get_class($params['date_requested']) : gettype($params['date_requested'])) . ' found.');
                }
                $this->date_requested = $params['date_requested'];
            }            
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function getApplication($params,$account=null,$course=null) {
        try {
            //var_dump($params);die();
            if (!is_array($params)){
                throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
            }
            
            if (!array_key_exists("limit", $params)){
                throw new Exception("Expected key (limit) in parameter array.");
            }
            
            if (!array_key_exists("status", $params)){
                throw new Exception("Expected key (status) in parameter  array.");
            }
            if (!array_key_exists("requestedby", $params)){
                throw new Exception("Expected key (requestedby) in parameter  array.");
            }

            $result = null;          
            $limit = intval($params['limit']);        
            //var_dump($role);die();    

            $status = $params['status'];
            $requestedby = $params['requestedby'];
			
			$select = JoinCourse::with(
				[
					'account' => function ($query) {
							$query->select('id','first_name','last_name');
						},
					'course_details'
				]
			)->where('join_courses.delete_status', '=', '0');
			//var_dump($select);die();		
			/*
            $select = DB::table('join_courses')
                    ->join('accounts', 'accounts.id', '=', 'join_courses.account')
                    ->join('courses', 'courses.id', '=', 'join_courses.course')
                    ->select('accounts.first_name','accounts.last_name', 'join_courses.status','join_courses.requestedby','courses.*')
                    ->where('join_courses.delete_status', '=', '0');
            */
			if($account){
                $select = $select
                        ->where('account', '=', $account);
            }
            if($course){
                $select = $select
                        ->where('course', '=', $course);
            }                    
            if ($status) {
                $select = $select
                        ->where('status', '=', $status);
            } 
            if ($requestedby) {
                $select = $select
                        ->where('requestedby', '=', $requestedby);
            }                                                
            //var_dump($select);die();       

            $rows = $select->orderBy('join_courses.date_requested','DESC')->paginate($limit);
            //var_dump($rows);die();       
            if (!count($rows)) {
                return false;
            }
            $result = $rows;

            return $result;
        } catch (Exception $ex) {

            LogRepository::printLog('error', $ex->getMessage());
        }
    }
}