<?php

namespace App\Http\Controllers\Courses\Course;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Courses\Course\ChangeStatusCustom;
use App\Repositories\Custom\Resource\Courses\Course\ChangeStatus as ResourceStatus;
use Exception;

class ChangeStatusController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth');
    }       

    public function put(Request $request, $id) {
        try {                      
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $ressource_status = new ResourceStatus($id);
            if (Gate::forUser($account)->denies('get', [$ressource_status,true])) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request.");
                return response()->json($result,400);
            }
			
            $status = $data['status'];

            $informations = array(
                'status' => $status,
            );
            //var_dump($account->getRole());die();
            $custom_status = new ChangeStatusCustom();            
            $result = $custom_status->update($informations,$id);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}