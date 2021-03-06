<?php

namespace App\Http\Controllers\Accounts\Account;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Accounts\Account\ApplicationsCustom;
use App\Repositories\Custom\Resource\Accounts\Account\Application as ResourceApplication;
use Exception;

class ApplicationsController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth');
    }       

    public function get(Request $request,$id) {
        try {                      
            $data = $request->only('account_id','limit','status','requestedby');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            //var_dump($account);die();
            $ressource_application = new ResourceApplication($id);
            if (Gate::forUser($account)->denies('get', [$ressource_application,true])) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result);
            }
            
            if(!$data['limit']){
                $limit = 12;
            }else{
                $limit = $data['limit'];
            }         

            $status = $data['status'];
            $requestedby = $data['requestedby'];

            $informations = array(
                'limit' => $limit,                
                'status' => $status,
                'requestedby' => $requestedby,
            );
            //var_dump($account->getRole());die();
            $custom_application = new ApplicationsCustom();            
            $result = $custom_application->getList($informations,$account);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}