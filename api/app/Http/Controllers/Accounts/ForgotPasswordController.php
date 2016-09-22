<?php

namespace App\Http\Controllers\Accounts;

use Gate;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\Accounts\ForgotPasswordCustom;
use \App\Repositories\Custom\Resource\Accounts\ForgotPassword as Resource_Forgot_Password;
use App\Repositories\Util\Email;

use Cache;

class ForgotPasswordController extends Controller{

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['post']]);
    }
    public function post(Request $request) {
        try {    
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $current_account = new AccountsCustom(intval($account_token_id)); // account of the user requesting the resource            
            $resource_forgot_password = new Resource_Forgot_Password();
            
            //checking user permission,
            if (Gate::forUser($current_account)->denies('post', [$resource_forgot_password,false])) {
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
            $email = array_key_exists("email", $data) ? $data["email"] : null;             			
            $informations = array(
                'email' => $email
            );

            $custom_forgot_password = new ForgotPasswordCustom($account_token_id);            
            $secret = $custom_forgot_password->forgot_password($informations);
            //$baseUrl = config('app.frontendBaseUrl');
                 $send = Mail::send('mails.reset-password', ['msg' => "Welcome on Afrikonline. This is the content of email.",'secret' => $secret], function ($m) use ($email, $email) {
                                  $m->from(env('MAIL_USERNAME'));
                                  $m->to($email)
                                    ->subject('Reset Password ');
                        });

                if (!$send) {
                    LogRepo::printLog('warning', " the email could not be sent.");
                      $result=array(
                        'code'=>'4000',
                        'description'=>'the email could not be sent'
                        );
                    return response()->json($result, 400);
                }
            return $result;
                       
        } catch (Exception $e) {
            LogRepo::printLog('error', $e->getMessage());
        }
    }          
}
