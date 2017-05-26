<?php

namespace App\Repositories\Custom\Accounts;

use Exception;
use App\Repositories\Util\LogRepository;
use Validator;
use App\Models\Account;
use Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


require_once __DIR__.'/../../google-api-php-client/vendor/autoload.php';

class SocialCustom {

    protected $_model;

    public function __construct() {
        $this->_model = $this->model();
        return $this;
    }


    public function model() {
        return new Account();
    }
    /**
     * valid param
     * 
     * @param array $param
     * @return boolean
     * @throws Exception
     */
    public function validate($params) {

        try {
         
            if (!is_array($params)){
                throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
            }

            if (!array_key_exists("network", $params)){
                throw new Exception("Expected key (network) in parameter array.");
            }

            if (!array_key_exists("network_token", $params)){
                throw new Exception("Expected key (network_token) in parameter array.");
            }            
            if (!is_string($params['network'])) {
                $result = array("code" => 400, "description" => "network is a string");
                echo json_encode($result, JSON_UNESCAPED_SLASHES);
                return false;
            }

            if (!is_string($params['network_token'])) {
                $result = array("code" => 400, "description" => "network_token is a string");
                echo json_encode($result, JSON_UNESCAPED_SLASHES);
                return false;
            }            
            return TRUE;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function db_save($params) {
        try { 
            $valid = $this->validate($params);
            if (!$valid) {
                http_response_code(400);
                die();
            }
            //var_dump($params);die();
            $network = $params['network'];
            $network_token = $params['network_token'];

            $facebook_client_id = config('app.facebook_client_id'); 
            $facebook_client_secret = config('app.facebook_client_secret');
            $facebook_redirect_url = config('app.facebook_redirect_url');

            if ($network == 'facebook') {                 
                if ($network_token) {                    
                    $url = 'https://graph.facebook.com/v2.6/me?access_token=' . $network_token . '&fields=email,id,first_name,last_name,third_party_id';

                    // Get cURL resource
                    $curl = curl_init();
                    // Set some options - we are passing in a useragent too here
                    curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => $url,
                    ));
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    // Send the request & save response to $resp
                    $resp = curl_exec($curl);
                    // Close request to clear up some resources
                    curl_close($curl);                    
                    $user = json_decode($resp,TRUE);
                    //var_dump($user);die();
                    if (isset($user['error'])) {
                        $result = array(
                            'code' => 400,
                            'error' =>$user['error']
                        );

                    return $result;
                    }
                    /* 
                    if(!array_key_exists('email', $user)){
                        $result = array("code" => 4000, "description" => "Missing Facebook permission for reading account email");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        http_response_code(400);
                        die();
                    }
                    */
                    if(!array_key_exists('third_party_id', $user)){
                        $result = array("code" => 4000, "description" => "third_party_id is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        http_response_code(400);
                        die();
                    }

                    if(!array_key_exists('id', $user)){
                        $result = array("code" => 4000, "description" => "facebook_id is required");
                        echo json_encode($result, JSON_UNESCAPED_SLASHES);
                        http_response_code(400);
                        die();
                    }                                       
                    
                    $fcb_id = $user['id'];
                    $email = array_key_exists("email", $user) ? $user["email"] : '';
                    $third_party_id = $user['third_party_id']; 
                    $first_name = array_key_exists("first_name", $user) ? $user["first_name"] : null;
                    $last_name = array_key_exists("last_name", $user) ? $user["last_name"] : null;
                    
                    $account = new Account();
                    $user = $account::where('facebook_id', '=', $fcb_id)->first();                    
                    //if user found 
                    if($user){
                        //$res = $account::where('email', 'LIKE BINARY', $email)->first();                    
                        if ($user->email) {
							/*
                            $informations = array(
                                'email' => $user->email,
                                'password' => $third_party_id
                            );
							*/
                            //$token = JWTAuth::attempt($informations);
							$token = JWTAuth::fromUser($user);
                            $result = array(
                                'code' => 200,
                                'token' => $token,
                                'account_id' => $user->id,
                                'logged' => true
                            );
                            //var_dump($result);die();
                            LogRepository::printLog('info', "Successful authentication of account #{" . $user . "} through Facebook.");
                            //var_dump($result);die();
                            return $result;
                        } else {                            
                            $result = array(
                                'code' => 200,
                                'email' => $email,
                                'social_id' => $third_party_id,
                                'first_name' => $first_name,
                                'last_name' => $last_name,
                                'logged' => false
                            );
                            return $result;
                        }                                            
                    }else{
                        $result = array(
                            'code' => 200,
                            'email' => $email,
                            'social_id' => $third_party_id,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'facebook_id' => $fcb_id,
                            'logged' => false,                            
                        );
                        return $result;
                    }
                } else {
                    $result = array(
                        'code' => 400,
                        'error' => $resp
                    );
                    return $result;
                }
            } else if ($network == 'google') {
                
                $client_id = config('app.google_client_id');
                $client_secret = config('app.google_client_secret');
                $redirect_uri = config('app.google_redirect_uri');
                $simple_api_key = config('app.google_simple_api_key');

                $client = new \Google_Client();

                $client->setApplicationName("SmartSchool LMS");
                $client->setClientId($client_id);
                $client->setClientSecret($client_secret);
                $client->setRedirectUri($redirect_uri);
                $client->setDeveloperKey($simple_api_key);
                $client->addScope("https://www.googleapis.com/auth/plus.profile.emails.read+https://www.googleapis.com/auth/plus.login+https://www.googleapis.com/auth/plus.me");

                $objOAuthService = new \Google_Service_Oauth2($client);

                if (isset($network_token)) {                
                    $client->authenticate($network_token);
                    $google_token = $client->getAccessToken();
                     if (!$google_token) {
                        $result = array(
                            'code' => 400,
                            'error' =>'invalid google access token'
                        );
                        
                        LogRepository::printLog('error', "Invalid google access token {" . var_export($google_token, true) . "}");
                    return $result;
                    }

                    $client->setAccessToken($google_token);
                    $userData = $objOAuthService->userinfo->get();
                    var_dump($userData);die();
                    if (!empty($userData)) {
                        $email = $userData->email?$userData->email:'';                        
                        $first_name = $userData->given_name;
                        $last_name = $userData->family_name;
                        $google_id = $userData->id;
                        $google_link = $userData->link;

                        $account = new Account();
                        $user = $account::where('google_id', '=', $google_id)->first();
						//$user = User::first();
						//$token = JWTAuth::fromUser($user);
                        //var_dump($user);die();
                        if($user){
                            if($user->email){
								/*
                                $informations = array(
                                    'email' => $user->email,
                                    'password' => $google_id
                                );
                                $token = JWTAuth::attempt($informations);
								*/
								$token = JWTAuth::fromUser($user);
                                $result = array(
                                    'code' => 200,
                                    'token' => $token,
                                    'account_id' => $user->id,
                                    'logged' => true
                                );
                                LogRepository::printLog('info', "Successful authentication of account #{" . $user . "} through Google.");
                                return $result;
                            } else {             
                                $result = array(
                                    'email' => $email,
                                    'social_id' => $google_id,
                                    'first_name' => $first_name,
                                    'last_name' => $last_name,
                                    'logged' => false
                                );                        
                                return $result;
                            }
                        }else{
                            $result = array(
                                'code' => 200,
                                'email' => $email,
                                'social_id' => $google_id,
                                'first_name' => $first_name,
                                'last_name' => $last_name,
                                'google_id' => $google_id,
                                'logged' => false
                            );
                            return $result;
                        }                                                                        
                    }else {
                        $result = array(
                            'code' => 400,
                            'error' =>  $google_token
                         );
                    
                        return $result;
                    }
                }
            }
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    /**
     * Format of the response
     * 
     * @param array $param
     * @return array
     */
    public function prepare_reponse_after_post($param) {
        try {

            $result = array(
                'code' => 200
            );

            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

}
