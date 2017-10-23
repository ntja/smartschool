<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;

class Account extends Authenticatable{

    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'accounts';
    public $timestamps = false;
    protected $fillable = [
        'first_name','last_name', 'phone', 'honorific', 'email', 'password','role','photo'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','verify_token','delete_status','is_active'
    ];

    public function __construct() {           
        return $this;
    }
    
    public function isOwner($resource)
    {	
        return $this->id == $resource->id;
    }

    public function getRole(){
        return $this->role;
    }
	public function getID(){
        return $this->id;
    }
		
    public function routeNotificationForMail(){
        return $this->email;
    }
    // 1 to * relationship with course table
	public function courses(){
        return $this->hasMany('App\Models\Course');
    }
	/*
	//many 2 many relationship with course table
	public function manyCourses(){
        return $this->belongsToMany('App\Models\Course','join_courses', 'account', 'course')->withPivot('status', 'requestedBy');
    }
	*/
	/*
	public function newPivot(Eloquent $parent, array $attributes, $table, $exists) {
        if ($parent instanceof App\Models\Course) {
            return new App\Models\JoinCourse($parent, $attributes, $table, $exists);
        }
        return parent::newPivot($parent, $attributes, $table, $exists);
    }
	*/
    public function dbSave($params) {
		//var_dump($params);die();
        try {            
            if (!is_array($params)){
				throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
			}                

            if (array_key_exists("email", $params)) {
                //throw new Exception("Expected key (email) in parameter array.");
                if (!is_string($params['email'])) {
                    throw new Exception("Expected String for key (email), " . (is_object($params['email']) ? get_class($params['email']) : gettype($params['email'])) . ' found.');
                }
                $this->email = $params['email'];
            }

            if (array_key_exists("role", $params)) {
                //throw new Exception("Expected key (role) in parameter array.");            
                if (!is_string($params['role'])) {
                    throw new Exception("Expected String for key (role), " . (is_object($params['role']) ? get_class($params['role']) : gettype($params['role'])) . ' found.');
                }
                $this->role = $params['role'];
            }
            if (array_key_exists("first_name", $params)) {
                //throw new Exception("Expected key (first_name) in parameter array.");            
                if (!is_string($params['first_name'])) {
                    throw new Exception("Expected String for key (first_name), " . (is_object($params['first_name']) ? get_class($params['first_name']) : gettype($params['first_name'])) . ' found.');
                }
                $this->first_name = $params['first_name'];
            }
            if (array_key_exists("last_name", $params)) {
                //throw new Exception("Expected key (last_name) in parameter array.");            
                if (!is_string($params['last_name'])) {
                    throw new Exception("Expected String for key (last_name), " . (is_object($params['last_name']) ? get_class($params['last_name']) : gettype($params['last_name'])) . ' found.');
                }
                $this->last_name = $params['last_name'];
            }            

			if (array_key_exists("honorific", $params)) {
                if(!is_null($params['honorific'])){
                    if (!is_string($params['honorific'])) {
                        throw new Exception("Expected String for key (honorific), " . (is_object($params['honorific']) ? get_class($params['honorific']) : gettype($params['honorific'])) . ' found.');
                    }
                }                
                $this->honorific = $params['honorific'];
            }
			
            if (array_key_exists("password", $params)) {
                //throw new Exception("Expected key (password) in parameter array.");            
                if (!is_string($params['password'])) {
                    throw new Exception("Expected String for key (password), " . (is_object($params['password']) ? get_class($params['password']) : gettype($params['password'])) . ' found.');
                }
                $this->password = Hash::make($params['password']);
            }     
			
            if (array_key_exists("phone", $params)) {
                //throw new Exception("Expected key (phone) in parameter array."); 
				if(!is_null($params['phone'])){
					if (!is_string($params['phone'])) {
						throw new Exception("Expected String for key (phone), " . (is_object($params['phone']) ? get_class($params['phone']) : gettype($params['phone'])) . ' found.');
					}
				}			
                $this->phone = $params['phone'];
            }
			
			if (array_key_exists("photo", $params)) {
                //throw new Exception("Expected key (name) in parameter array.");            
				if(!is_null($params['photo'])){
					if (!is_string($params['photo'])) {
						throw new Exception("Expected String for key (photo), " . (is_object($params['photo']) ? get_class($params['photo']) : gettype($params['photo'])) . ' found.');
					}
				}                
                $this->photo = $params['photo'];
            }
			if (array_key_exists("date_created", $params)) {				
				$this->date_created = $params['date_created'];
            }
			
			if (array_key_exists("verify_token", $params)) {				
				$this->verify_token = $params['verify_token'];
            }
			
			if (array_key_exists("verified_status", $params)) {				
				$this->verified_status = $params['verified_status'];
            }
			//var_dump($params);
			//die();
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
            
            if (!array_key_exists("role", $params)){
                throw new Exception("Expected key (role) in parameter  array.");
            }
           if (!array_key_exists("verified_status", $params)){
                throw new Exception("Expected key (verified_status) in parameter  array.");
            }
            $result = null;
            $role = $params['role'];
            $verified_status = $params['verified_status'];
            $limit = intval($params['limit']);
            $select = DB::table('accounts')
					->select('id','first_name','last_name','role', 'email','verified_status','is_active','photo','phone','subscription','honorific','date_created')
                    //->skip(0)
					 ->where('delete_status', '=', '0');
            if ($verified_status) {
                $select = $select
                        ->where('verified_status', '=', $verified_status);
            }
            if ($role) {
                $select = $select
                        ->where('role', '=', $role);
            }
            //die("here");
            $rows = $select->orderBy('id','DESC')->paginate($limit);
            if (!count($rows)) {
                return false;
            }
            return $rows;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }        
}
