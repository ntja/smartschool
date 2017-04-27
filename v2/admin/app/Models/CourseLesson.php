<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;

class CourseLesson extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'course_lessons';
    public $timestamps = false;
    protected $fillable = [
        'title','content','section'
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
    
	// 1 to * relationship with section table
    public function section(){
        return $this->belongsTo('App\Models\CourseSection');
    }

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
            if (array_key_exists("content", $params)) {
				if (!is_string($params['content'])) {
					throw new Exception("Expected String for key (content), " . (is_object($params['content']) ? get_class($params['content']) : gettype($params['content'])) . ' found.');
				}
                $this->content = $params['content'];
            }   
			if (array_key_exists("objective", $params)) {
				if (!is_string($params['objective'])) {
					throw new Exception("Expected String for key (objective), " . (is_object($params['objective']) ? get_class($params['objective']) : gettype($params['objective'])) . ' found.');
				}
                $this->objective = $params['objective'];
            } 
			if (array_key_exists("section", $params)) {
				if (!is_string($params['section'])) {
					throw new Exception("Expected String for key (section), " . (is_object($params['section']) ? get_class($params['section']) : gettype($params['section'])) . ' found.');
				}
                $this->section = $params['section'];
            } 
			
            if (array_key_exists("date_created", $params)) {
                if (!is_string($params['date_created'])) {
                    throw new Exception("Expected String for key (date_created), " . (is_object($params['date_created']) ? get_class($params['date_created']) : gettype($params['date_created'])) . ' found.');
                }
                $this->date_created = $params['date_created'];
            }
			//var_dump($params);die();
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
}