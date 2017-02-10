<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\UserCustom;

class UserController extends Controller {
    
    public function __construct() {
        
    }

    /*
     * Home page
     */

    public function home() {
        return view('home');
    }
    
    /*
     * Login page
     */

    public function login() {        
        return view('user.login');
    }

    /*
     * Register page
     */

    public function register(Request $request) {
        
        $api_path = config()->get('app.api_path');
        $url = $api_path . '/accounts';

        if ($request->method() == 'POST') {
            $firstname = $request->input('firstname');
            $lastname = $request->input('lastname');
            $email = $request->input('email');
            $password = $request->input('password');
            $role = $request->input('actype');
            $honorific = $request->input('honorific');
            
            $curl = curl_init();
//            Session::put('clef', 'ma valeur');
//            
//            var_dump(Session::get('clef'));


            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_HTTPHEADER => array(
                    "x-client-id: 0000"
                ),
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS =>
                json_encode(array(
                    'email' => $email,
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'honorific' => $honorific,
                    'role' => $role,
                    'password' => $password
                ))
            ));

            $resp = curl_exec($curl);
            $resp_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);
            if ($resp_code == 200 || $resp_code == 201) {
                $responseText = json_decode($resp);
                var_dump($responseText->code);
                if ($responseText->code == 201 && $responseText->id) {
                    if ($data = $this->authenticate($email, $password)) {
                        $_SESSION['account_id'] = $data->account_id;
                        $_SESSION['token'] = $data->token;                       
                        return redirect('account/edit-profile');
                    }
                }
            }
        }
        return view('user.register', ['error' => 'An error ocured', '']);
    }

    public function authenticate($email, $password) {

        $api_path = config()->get('app.api_path');
        $url = $api_path . '/accounts/authenticate';
        $result = false;

        $curl = curl_init();
//            Session::put('clef', 'ma valeur');
//            
//            var_dump(Session::get('clef'));


        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                "x-client-id: 0000"
            ),
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS =>
            json_encode(array(
                'email' => $email,
                'password' => $password
            ))
        ));

        $resp = curl_exec($curl);
        $resp_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($resp_code == 200) {
            $responseText = json_decode($resp);
            $result = $responseText;
        }

        return $result;
    }

    public function post(Request $request) {
        try {
            die('here');
            $users_info = file_get_contents('php://input');
            //print_r($users_info);exit;
            $user = json_decode($users_info, TRUE);

            if (!is_array($user)) {
                return $result = array("code" => 403, "error" => "invalid request body");
            }
            $usr = new User();
            $name = array_key_exists("first_name", $user) ? $user["first_name"] : null;
            $email = array_key_exists("email", $user) ? $user["email"] : null;
            $password = array_key_exists("password", $user) ? $user["password"] : null;
            //$password_confirmation = array_key_exists("password_confirmation", $user) ? $user["password_confirmation"] : null;

            $user_iformation = ['first_name' => $name, 'email' => $email, 'password' => $password];
            $rules = ['email' => 'required|email|unique:users', 'first_name' => 'required|min:3', 'password' => 'required|min:3'];

            $validator = Validator::make($user_iformation, $rules);
            if ($validator->passes()) {

                $usr->first_name = $name;
                $usr->email = $email;
                $usr->password = Hash::make($password);
                $usr->save();
                return $result = array("code" => 200, "error" => "The user has been created.");
            } else {
                return response()->json(['error' => $validator->messages()->all()]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

}
