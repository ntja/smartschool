<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Exception;
use App\Repositories\Util\LogRepository;
use DB;

class CourseCategory extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'course_categories';
    public $timestamps = false;
    protected $fillable = [
        'name','shortname','description'
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
        
    public function course(){
        return $this->hasMany('App\Models\Course');
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
                if (!is_string($params['shortname'])) {
                    throw new Exception("Expected String for key (shortname), " . (is_object($params['shortname']) ? get_class($params['shortname']) : gettype($params['shortname'])) . ' found.');
                }
                $this->shortname = $params['shortname'];
            }

            if (array_key_exists("description", $params)) {
                //throw new Exception("Expected key (description) in parameter array.");
                if (!is_null($params['description'])) {
                    if (!is_string($params['description'])) {
                        throw new Exception("Expected String for key (description), " . (is_object($params['description']) ? get_class($params['description']) : gettype($params['description'])) . ' found.');
                    }                    
                }    
                $this->description = $params['description'];            
            }

            if (array_key_exists("date_created", $params)) {
                //throw new Exception("Expected key (date_created) in parameter array.");
                if (!is_string($params['date_created'])) {
                    throw new Exception("Expected String for key (date_created), " . (is_object($params['date_created']) ? get_class($params['date_created']) : gettype($params['date_created'])) . ' found.');
                }
                $this->date_created = $params['date_created'];
            }            
			//var_dump($params);die();
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }

    public function getList($params) {
        try {
            if (!is_array($params)){
                throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
            }           
            if (!array_key_exists("limit", $params)){
                throw new Exception("Expected key (limit) in parameter array.");
            }
			$rows = null;
            $limit = intval($params['limit']);
			$rows = DB::table('course_categories')->where('delete_status', '=', '0')->orderBy('name','ASC')->paginate($limit);           
            if (!count($rows)) {
                return false;
            }
            return $rows;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }
}