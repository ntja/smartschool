<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\UserCustom;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['create']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $d =  $request->only('user');
        
//        dd($d);
        $users = User::all();
        
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        try{
            
            $user_info = file_get_contents('php://input');
            $data = json_decode($user_info, TRUE);

            if (!is_array($data)) {
                
                $result = array("code" => 400, "description" => "invalide request body");
                
                return $result;
            }
            
            $email = array_key_exists("email", $data) ? $data["email"] : null;
            $password = array_key_exists("password", $data) ? $data["password"] : null;
            $name = array_key_exists("name", $data) ? $data["name"] : null;
            
            $informations = array(
                    'email' => $email,
                    'password' => $password,
                    'name' => $name,
            );
//            dd($informations);
            $custom_user = new UserCustom();
            
            if($custom_user->validate($informations)){
                $custom_user->email = $informations['email'];
                $user->password = Hash::make($informations['password']);
                $custom_user->name = $informations['name'];
                $custom_user->save();
                $result=array("code" => 201,"description"=>"Data Inserted");
            
                return $result;
            } else {
                throw new Exception("Invalid data");
            }

        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage(), $context);
        } 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function put($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }
}
