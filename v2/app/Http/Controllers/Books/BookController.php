<?php

namespace App\Http\Controllers\Books;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Books\BookCustom;
use App\Repositories\Custom\Resource\Books\Book as ResourceBook;
use Exception;

class BookController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['get']]);
    }    

    /**
     * create  new resource.
     *
     * @return \Illuminate\Http\Response
     */
	 /*
    public function put(Request $request) {
        try {                      
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $ressource_category = new ResourceCategory();
            if (Gate::forUser($account)->denies('post', $ressource_category)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result);
            }
            $course_info = file_get_contents('php://input');
            $data = json_decode($course_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 400, "description" => "invalid request body");
                return response()->json($result, 400);
            }

            //retrieve inputs
            $name = array_key_exists("name", $data) ? $data["name"] : null;            

            $informations = array(
                'name' => $name,                
            );
			//var_dump($informations);die();
            $custom_category = new CategoriesCustom();            
            $result = $custom_category->dbSave($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
	*/
	
    public function get(Request $request, $id) {
        try {                      
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $resource_book = new ResourceBook();
			//var_dump($account->getRole());die();
            if (Gate::forUser($account)->denies('get', $resource_book)) {
                $result = array("code" => 4003, "description" => "You do not have permissions for that request..");
                echo json_encode($result, JSON_UNESCAPED_SLASHES);
                http_response_code(400);
               die();
            }
			
            $informations = array(
                'id' => $id,				
            );
            //var_dump($account->getRole());die();
            $custom_book = new BookCustom();
            $result = $custom_book->getBook($informations,$account->model()->getID());            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
	public function put(Request $request, $id) {
        try {                       
            //retrieving current user ID based on its token                 
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $ressource_category = new ResourceCategory();
            if (Gate::forUser($account)->denies('get', $ressource_category)) {
                $result = array("code" => 4003, "description" => "You do not have permissions for that request..");
                echo json_encode($result, JSON_UNESCAPED_SLASHES);
                http_response_code(400);
               die();
            }
            $json_data = file_get_contents('php://input');
            $decode_data = json_decode($json_data, TRUE);    
			//var_dump($json_data);die();			
            if(!is_array($decode_data)){
                $result = array("code" => 4000, "error" => "invalid request body");
                return response()->json($result,400);
            }            
            $entries = array_key_exists("entries", $decode_data)?$decode_data['entries']:null;
            if(!is_array($entries)){
                $result = array("code" => 4000, "error" => "invalid request body");
                return response()->json($result,400);
            }           
			//var_dump($entries);die();
			for($i=0; $i<count($entries);$i++){
				foreach($entries[$i] as $key=>$value){
					if(($key != "field") && ($key != "value")){
						$result = array("code" => 4000, "error" => "invalid request body");
						return response()->json($result,400);
					}
				}
			}			
            for($i=0; $i<count($entries);$i++){
                $info[$entries[$i]['field']] = $entries[$i]['value'];
            }
            //var_dump($info);die();
            $custom_product = new BookCustom((int)$id);
            return $custom_product->editBook($info, $id);
        } catch (Exception $e) {
            LogRepo::printLog('error', $e->getMessage());
			die();
		}
	}
}