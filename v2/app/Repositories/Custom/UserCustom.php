<?php

namespace App\Repositories\Custom;

use Bosnadev\Repositories\Eloquent\Repository;
use App\Repositories\Util\LogRepository;
use Exception;

class UserCustom extends Repository {
    
    public function __construct() {
        return $this;
    }
    
    public function model() {
        return \App\User::class;
    }
    
    public function getRole() {
        
    }

    public function validate($param) {
        try{
            if (!is_array($param)) {
                throw new Exception("Expected array as parameter , " . (is_object($level) ? get_class($level) : gettype($level)) . " found.");
            }
            
            if(!array_key_exists('email', $param)){
                throw new Exception("Expected 'email' in array as parameter , " . (is_object($param['email']) ? get_class($param['email']) : gettype($param['email'])) . " found.");
            }
            
            if(!array_key_exists('name', $param)){
                throw new Exception("Expected 'name' in array as parameter , " . (is_object($param['name']) ? get_class($param['name']) : gettype($param['name'])) . " found.");
            }
            
            if(!array_key_exists('password', $param)){
                throw new Exception("Expected 'password' in array as parameter , " . (is_object($param['password']) ? get_class($param['password']) : gettype($param['password'])) . " found.");
            }
            
            
            $result = null;
            $validator = Validator::make($param, [
                'email' => 'required|unique:posts|max:255',
                'name' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                $result = FALSE;
            } else {
                $result = TRUE;
            }
            
            return $result;
            
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
}
