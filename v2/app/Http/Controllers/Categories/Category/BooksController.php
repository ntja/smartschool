<?php

namespace App\Http\Controllers\Categories\Category;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\Categories\Category\BooksCustom;
use App\Repositories\Custom\Resource\Categories\Category\Book as ResourceBook;
use Exception;

class BooksController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth',['except' => ['get']]);
    }    

    public function get(Request $request, $id) {
        try {                      
            $data = $request->only('account_id','limit');
            $account_token_id = $data['account_id'];
            $account = new AccountsCustom($account_token_id);
            $resource_book = new ResourceBook();
            if (Gate::forUser($account)->denies('get', $resource_book)) {
                $result = array("code" => 4003, "description" => "You do not have permissions for that request.");
                return response()->json($result,403);
            }
            
            if(!$data['limit']){
                $limit = 12;
            }else{
                $limit = $data['limit'];
            }

            $informations = array(
                'limit' => $limit,                
                'category' => $id,
            );
            //var_dump($account->getRole());die();
            $custom_book = new BooksCustom();            
            $result = $custom_book->getList($informations);
            return $result;
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
            die();
        }
    }
}