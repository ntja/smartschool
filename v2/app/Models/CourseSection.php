<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;

class CourseSection extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'course_sections';
    public $timestamps = false;
    protected $fillable = [
        'title','description','course', 'is_visible'
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
    
	// 1 to * relationship with lesson table
    public function lessons(){
        return $this->hasMany('App\Models\CourseLesson','section');
    }
	
	// 1 to * relationship with course table
	public function course(){
        return $this->belongsTo('App\Models\Course');
    }
	
    public function DbSave($params) {
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
			if (array_key_exists("course", $params)) {
				if (!is_string($params['course'])) {
					throw new Exception("Expected String for key (course), " . (is_object($params['course']) ? get_class($params['course']) : gettype($params['course'])) . ' found.');
				}
                $this->course = $params['course'];
            }
			if (array_key_exists("is_visible", $params)) {
				if (!is_numeric($params['is_visible'])) {
					throw new Exception("Expected Number for key (is_visible), " . (is_object($params['is_visible']) ? get_class($params['is_visible']) : gettype($params['is_visible'])) . ' found.');
				}
                $this->is_visible = $params['is_visible'];
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
	
	public function getSections($params, $course_id) {
        try {
            //var_dump($params);die();
            if (!is_array($params)){
                throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
            }
            
            if (!array_key_exists("limit", $params)){
                throw new Exception("Expected key (limit) in parameter array.");
            }
			
            $result = null;          
            $limit = intval($params['limit']);

			$is_visible = $params['is_visible'];
			/*
			$select = DB::table('courses')
					->join('course_categories', 'course_categories.id', '=', 'courses.category')
					->join('accounts', 'accounts.id', '=', 'courses.instructor')
					->select('courses.*', 'course_categories.name as category_name','accounts.first_name','accounts.last_name')
					//->skip(0)
					->where('courses.delete_status', '=', '0');
					//->take($limit);
				*/
			$select = CourseSection::with(
			[
				'lessons'=> function ($query) {
					$query->select('id','title','content','section');
				}
			]
			)->where('course_sections.delete_status', '=', '0')->where('course_sections.course',$course_id);
			
            $rows = $select->orderBy('id','ASC')->paginate($limit);
            //var_dump($rows);die();       
            if (!count($rows)) {
                return false;
            }
            return $rows;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
}