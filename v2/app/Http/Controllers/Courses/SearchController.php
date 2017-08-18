<?php

namespace App\Http\Controllers\Courses;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Courses\SearchCustom;
use App\Repositories\Custom\Resource\Courses\Search as ResourceSearch;
use Exception;

class SearchController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['get']]);
    }    
   
    public function get(Request $request) {
        try {                      
            $data = $request->only('account_id','limit','query');			
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
			//var_dump($account);die();
            $resource_search = new ResourceSearch();
            if (Gate::forUser($account)->denies('get', $resource_search)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request.");
                return response()->json($result, 400);
            }
			
            if (!$data['limit']) {
                $data['limit'] = 10; //set default value of limit param 
            }
			
            $limit = $data['limit'];
            $query = $data['query'];
			var_dump($query);die();
			if($query){
				$query = explode(" ", trim($query));
			}
            $informations = array(
				'query' => $query,                
                'limit' => $limit,                
            );
            //$informations = $info;
            //var_dump($informations);die();
            $custom_search = new SearchCustom();            
            $result = $custom_search->search($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
            die();
        }
    }       
}
