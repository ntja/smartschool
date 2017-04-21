<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\CategoriesCustom;
use App\Repositories\Custom\Resource\Category as ResourceCategory;
use Exception;

class CategoriesController extends Controller {

    public function __construct() {
       $this->middleware('jwt.auth', ['except' => ['get']]);
    }    

    /**
     * create  new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request) {
        try {                      
            $data = $request->only('account_id', 'type', 'limit');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $resource_category = new ResourceCategory();
            if (Gate::forUser($account)->denies('get', $resource_category)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request.");
                return response()->json($result, 400);
            }    
			if(!$data['limit']){
                $limit = 20;
            }else{
                $limit = $data['limit'];
            }
			$type = $data['type'];
			if (!$type) {
                $result = array("code" => 400, "description" => "'type' query parameter is required");
                return response()->json($result, 400);
            }			
            $informations = [
				'type' => $type,
				'limit' => $limit,
			];
                
			//var_dump($informations);die();
			$custom_category = new CategoriesCustom(); 
			
            $result = $custom_category->getList($informations,$account);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}