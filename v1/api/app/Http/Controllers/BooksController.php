<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\BooksCustom;
use App\Repositories\Custom\Resource\Book as ResourceBook;
use Exception;

class BooksController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth');
    }    

    /**
     * create  new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request) {
        try {                      
            $data = $request->only('account_id');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            //var_dump($account);die();
            $ressource_book = new ResourceBook();
            if (Gate::forUser($account)->denies('post', $ressource_book)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result);
            }
            $book_info = file_get_contents('php://input');
            $data = json_decode($book_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 400, "description" => "invalid request body");
                return response()->json($result, 400);
            }

            //retrieve user inputs
            $name = array_key_exists("name", $data) ? $data["name"] : null;
            $author = array_key_exists("author", $data) ? $data["author"] : null;           
            $size   = array_key_exists("size", $data) ? $data["size"] : null;
            $description   = array_key_exists("description", $data) ? $data["description"] : null;
            $language   = array_key_exists("language", $data) ? $data["language"] : null;
            $cover   = array_key_exists("cover", $data) ? $data["cover"] : null;
            $filepath   = array_key_exists("filepath", $data) ? $data["filepath"] : null;
            $format   = array_key_exists("format", $data) ? $data["format"] : null;            
            $category   = array_key_exists("category", $data) ? $data["category"] : null;


            $informations = array(
                'name' => $name,
                'author' => $author,
                'language' => $language,
				'size' => $size,
                'description' => $description, 				
                'cover' => $cover,
                'filepath' => $filepath,
                'format' => $format,                
                'category' => $category,
            );
			//var_dump($informations);die();
            $custom_book = new BooksCustom();            
            $result = $custom_book->dbSave($informations);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }

    public function get(Request $request) {
        try {                      
            $data = $request->only('account_id','limit','category');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $ressource_book = new ResourceBook();
            if (Gate::forUser($account)->denies('get', $ressource_book)) {
                $result = array("code" => 403, "description" => "You do not have permissions for that request..");
                return response()->json($result);
            }
            
            if(!$data['limit']){
                $limit = 12;
            }else{
                $limit = $data['limit'];
            }         

            $category = $data['category'];            

            $informations = array(
                'limit' => $limit,                
                'category' => $category,
            );
            //var_dump($account->getRole());die();
            $custom_book = new BooksCustom();            
            $result = $custom_book->getList($informations,$account);            
            return response()->json($result);
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
            die();
        }
    }
}