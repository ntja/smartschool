<?php

namespace App\Http\Controllers\Accounts;

use Gate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\Accounts\RecoverPasswordCustom;
use \App\Repositories\Custom\Resource\Accounts\RecoverPassword as Resource_Recover_Password;
use Crypt;
use Cache;

class RecoverPasswordController extends Controller{

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['post']]);
    }
    public function post(Request $request) {
        try {                 			
            $data = $request->only('key','account_id');            
            $account_token_id = $data['account_id'];
            $key = $data["key"];     
            //var_dump($key);die();       
            $current_account = new AccountsCustom(intval($account_token_id)); // account of the user requesting the resource            
            $resource_recover_password = new Resource_Recover_Password();
            
            //checking user permission,
            if (Gate::forUser($current_account)->denies('post', [$resource_recover_password,false])) {
                 LogRepo::printLog('info', "Invalid attempt to read account #{" .$account_token_id. "}. Returned code: 4004.");
                $result = array("code" => 4003, "description" => "You do not have permissions for that request..");
                return $result;
            }  

            $recover_password_info = file_get_contents('php://input');
            $data = json_decode($recover_password_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 4000, "description" => "invalid request body");
                return $result;
            }

            //retrieve user inputs
            $password = array_key_exists("password", $data) ? $data["password"] : null;  
            try{
                $decrypt_secret = json_decode(Crypt::decrypt($key));
            }catch(DecryptException $e){
                LogRepository::printLog('error', $e->getMessage());
                die();
            }			
            //var_dump($decrypt_secret);die();
            $date = $decrypt_secret->date;
            $date_expiration = date("Y-m-d H:m:i",strtotime($date)+(30*24*60*60));
            $current_date = date("Y-m-d H:m:i");
            $is_valid = strtotime($date_expiration) - strtotime($current_date);
            if($is_valid>=0){
                $id = $decrypt_secret->id;
                //var_dump($date_expiration);die();
                
                $informations = array(
                    'id' => intval($id),
                    'password' => $password
                );

                $custom_recover_password = new RecoverPasswordCustom($account_token_id);            
                $result = $custom_recover_password->recover_password($informations);

                return $result;
            } else{
                http_response_code(400);
                $result = array("code" => 4000, "description" => "Link expired. Request a new one");
                echo json_encode($result, JSON_UNESCAPED_SLASHES);            
               die();
            }           
                       
        } catch (Exception $e) {
            LogRepo::printLog('error', $e->getMessage());
        }
    }          
}
