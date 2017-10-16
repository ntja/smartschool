<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Util\LogRepository as LogRepo;
use App\Repositories\Custom\AccountsCustom;
use App\Repositories\Custom\TagsCustom;
use App\Repositories\Custom\Resource\Tag as ResourceTag;
use Exception;

class TagsController extends Controller {

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
            $resource_tag = new ResourceTag();
            if (Gate::forUser($account)->denies('post', $resource_tag)) {
                $result = array("code" => 4003, "description" => "You do not have permissions for that request.");
                return response()->json($result, 400);
            }
            $tag_info = file_get_contents('php://input');
            $data = json_decode($tag_info, TRUE);
            if (!is_array($data)) {
                $result = array("code" => 4000, "description" => "invalid request body");
                return response()->json($result, 400);
            }

            //retrieve tag inputs
            $name = array_key_exists("name", $data) ? $data["name"] : null;
            $is_active = array_key_exists("is_active", $data) ? $data["is_active"] : '0';

            $informations = [
				'name' => $name,
                'is_active' => $is_active,
			];                
			//var_dump($informations);die();
            $custom_tag = new TagsCustom();            
            $result = $custom_tag->dbSave($information);            
            return $result;
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
            die();
        }
    }
}