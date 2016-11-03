<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
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

    public function getRole()
    {
        return $this->role;
    }
		
    public function routeNotificationForMail(){
        //return $this->email;
    }
    
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
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function getList($params) {
        try {
            if (!is_array($params)){
                throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
            }

            if (!array_key_exists("before", $params)){
                throw new Exception("Expected key (before) in parameter array.");
            }
            if (!array_key_exists("after", $params)){
                throw new Exceptionn("Expected key (after) in parameter array.");
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
            $after = $params['after'];
            $before = $params['before'];
            $role = $params['role'];
            $verified_status = $params['verified_status'];
            $limit = intval($params['limit']);
            $select = DB::table('accounts')
                    ->skip(0)
					 ->where('delete_status', '=', 0)
                    ->take($limit);            
            if ($verified_status) {
                $select = $select
                        ->where('verified_status', '=', $verified_status);
            }
            if ($role) {
                $select = $select
                        ->where('role', '=', $role);
            }
            if ($after) {
                $select = $select
                        ->where('id', '<', base64_decode($after))
                        ->orderBy('id', 'desc');
            }
            if ($before) {
                $select = $select
                        ->where('id', '>', base64_decode($before))
                        ->orderBy('id', 'asc');
            }
            if ((!$before) && (!$after)) {
                $select = $select
                        ->orderBy('id', 'desc');
            }
            $rows = $select->get();
            if (!count($rows)) {
                return false;
            }
            $result = $rows;

            return $result;
        } catch (Exception $ex) {

            LogRepository::printLog('error', $ex->getMessage());
        }
    }
    
    public function hasNext($after, $limit,$role,$verified_status) {
        try {
            if (!is_numeric($after))
                throw new Exception("Expected Int for value after , " . (is_object($after) ? get_class($after) : gettype($after)) . " found.");

            if (!is_numeric($limit))
                throw new Exception("Expected Int for value limit , " . (is_object($limit) ? get_class($limit) : gettype($limit)) . " found.");
            
            $result = false;
            $select = DB::table('accounts')
                    ->where('id', '<', $after)
                    ->skip(0)
					 ->where('delete_status', '=', 0)
                    ->take($limit)
                    ->orderBy('id', 'desc');                 
            if ($role) { 
                $select = $select
                        ->where('role', '=', $role);
            }
            if ($verified_status) { 
                $select = $select
                        ->where('verified_status', '=', $verified_status);
            }            
            $row = $select->get();
            if ($row) {
                $result = true;
            }

            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
    
    public function hasPrevious($before, $limit, $role, $verified_status) {
        try {
            if (!is_numeric($before))
                throw new Exception("Expected Int for value before , " . (is_object($before) ? get_class($before) : gettype($before)) . " found.");

            if (!is_numeric($limit))
                throw new Exception("Expected Int for value limit , " . (is_object($limit) ? get_class($limit) : gettype($limit)) . " found.");

            $result = false;
            $select = DB::table('accounts')
                    ->where('id', '>', $before)
                    ->skip(0)
					 ->where('delete_status', '=', 0)
                    ->take($limit)
                    ->orderBy('id', 'desc');                    
            if ($role) { 
                $select = $select
                        ->where('role', '=', $role);
            }            
            if ($verified_status) { 
                $select = $select
                        ->where('verified_status', '=', $verified_status);
            }

            $row = $select->get();
            if ($row) {
                $result = true;
            }

            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
	
	public function getAll($params) {
        try {
            if (!is_array($params)){
                throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
            }

            if (!array_key_exists("before", $params)){
                throw new Exception("Expected key (before) in parameter array.");
            }
            if (!array_key_exists("after", $params)){
                throw new Exceptionn("Expected key (after) in parameter array.");
            }                        
            if (!array_key_exists("role", $params)){
                throw new Exception("Expected key (role) in parameter  array.");
            }
            if (!array_key_exists("verified_status", $params)){
                throw new Exception("Expected key (verified_status) in parameter  array.");
            }           

            $result = null;
            $after = $params['after'];
            $before = $params['before'];
            $role = $params['role'];
            $verified_status = $params['verified_status'];
            
			$count = Account::count();
			$skip = 0;
			$limit = $count - $skip;
            $select = DB::table('accounts')
                    ->skip($skip)
					 ->where('delete_status', '=', 0)
					->limit($limit);            
            if ($role) {
                $select = $select
                        ->where('role', '=', $role);
            }
            if ($verified_status) {
                $select = $select
                        ->where('verified_status', '=', $verified_status);
            }
            if ($after) {
                $select = $select
                        ->where('id', '<', base64_decode($after))
                        ->orderBy('id', 'desc');
            }
            if ($before) {
                $select = $select
                        ->where('id', '>', base64_decode($before))
                        ->orderBy('id', 'asc');
            }
            if ((!$before) && (!$after)) {
                $select = $select
                        ->orderBy('id', 'desc');
            }
            $rows = $select->get();
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
