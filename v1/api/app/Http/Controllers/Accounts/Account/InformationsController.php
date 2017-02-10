<?php
namespace App\Http\Controllers\Accounts\Account;
use DB;
use Gate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller; 
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\Accounts\Account\InformationsCustom; 
use \App\Repositories\Custom\Resource\Accounts\Account\Informations as Resource_Informations;

class InformationsController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth');
    }
    public function post(Request $request, $id) {
        try {    
            //retrieving current user ID based on its token
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            //var_export($data);die();
            $current_account = new AccountsCustom(intval($account_token_id)); // account of the user requesting the resource                     
            //checking user permission,
            $resource_informations = new Resource_Informations((int)$id);
            //var_export($resource_informations);die();
            if (Gate::forUser($current_account)->denies('post', [$resource_informations,true])) {
                LogRepo::printLog('info', "Invalid attempt to update informations of another account #{" .$id. "}. Returned code: 4007.");
                $result = array("code" => 4007, "description" => "You do not have permissions for that request..");
                return response()->json($result,400);
            }
			$json_data = file_get_contents('php://input');
            $decode_data = json_decode($json_data, TRUE);           
            if(!is_array($decode_data)){
                $result = array("code" => 4000, "error" => "invalid request body");
                return response()->json($result,400);
            }            
            $entries = array_key_exists("entries", $decode_data)?$decode_data['entries']:null;
            if(!is_array($entries)){
                $result = array("code" => 4000, "error" => "invalid request body");
                return response()->json($result,400);
            }           
            
            for($i=0; $i<count($entries);$i++){
                $info[$entries[$i]['field']] = $entries[$i]['value'];
            }
            
            //var_export($info);die();
            /*
            $first_name = array_key_exists("first_name", $data) ? $data["first_name"] : null;
			$last_name = array_key_exists("last_name", $data) ? $data["last_name"] : null;
			$phone = array_key_exists("phone", $data) ? $data["phone"] : null;
            $informations = array(
                'first_name' => $first_name,
				'last_name' => $last_name,
				'phone' => $phone
            );
            */
			//var_dump($informations);die();
            $custom_info = new InformationsCustom();
			return $custom_info->updateAccount($info, $id);                               
        } catch (Exception $e) {
            LogRepo::printLog('error', $e->getMessage());
        }
    }
}

