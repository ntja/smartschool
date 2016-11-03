<?php 

namespace App\Http\Controllers\Accounts\Account;

use Gate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Custom\Accounts\Account\PasswordCustom;
use App\Repositories\Custom\AccountsCustom;
use \App\Repositories\Custom\Resource\Accounts\Account\Password as ResourceAccountPassword;


class PasswordController extends Controller {
    
     public function __construct() {
        $this->middleware('jwt.auth');
    }
    
    public function post(Request $request, $id){
        //  Retreeive the ID of the logged user
        $param = $request->only('account_id');        
        $account_token_id = $param['account_id'];
        
        $account = new AccountsCustom(intval($account_token_id));
              
        $resource_account_password = new ResourceAccountPassword((int)$id);
        // Check access rights to the resource
        if (Gate::forUser($account)->denies('post', [$resource_account_password,true])) {
            $result = array("code" => 4003, "description" => "You do not have permissions for that request..");
            return response()->json($result,400);
        }
        
        //retrieve user inputs
        $json_data = file_get_contents('php://input');
        $decode_data = json_decode($json_data, TRUE);
        if(!is_array($decode_data))
        {
            $result = array("code" => 4000, "error" => "invalid request body");
            return response()->json($result,400);
        }
        $new_password = array_key_exists("new_password", $decode_data) ? $decode_data["new_password"] : null;
        $password = array_key_exists("password", $decode_data) ? $decode_data["password"] : null;

        $informations = [
            'new_password' => $new_password,
            'password' => $password,
            'id' => intval($id),
        ];
        
        // validate input and update password
        $custom_account_password = new PasswordCustom($account_token_id);        
        $result = $custom_account_password->updatePassword($informations);
        return $result;
        
    }
}