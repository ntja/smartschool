<?php

namespace App\Http\Controllers\Accounts;

use Gate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\Accounts\AccountCustom;
use \App\Repositories\Custom\Resource\Accounts\Account as ResourceAccounts;

use Cache;

class AccountController extends Controller{

    public function __construct() {
        $this->middleware('jwt.auth');
    }
    public function get(Request $request, $id) {
        try {                 			
            //retrieving current user ID based on its token           			
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];            
            $current_account = new AccountsCustom(intval($account_token_id)); // account of the user requesting the resource
			//var_dump($current_account);die();
            $resource_accounts = new ResourceAccounts((int)$id);
            
            //checking user permission,
            if (Gate::forUser($current_account)->denies('get', [$resource_accounts,false])) {
                 LogRepo::printLog('info', "Invalid attempt to read account #{" .$id. "}. Returned code: 4004.");
                $result = array("code" => 4003, "description" => "You do not have permissions for that request.");
                return $result;
            }
            $informations = array(
                'id' => (int)$id,				
            );

            $custom_account = new AccountCustom($account_token_id);            
            $validate = $custom_account->validate($informations);
            if ($validate) {      
                return response()->json($custom_account->getAccount($informations));
            }           
        } catch (Exception $e) {
            LogRepo::printLog('error', $e->getMessage());
        }
    }          
}
