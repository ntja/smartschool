<?php

namespace App\Repositories\Custom\Books;

use Exception;
use App\Repositories\Custom\BooksCustom;
use App\Repositories\Util\LogRepository as LogRepo;

class BookCustom {
    
	protected $_booksCustom;	
	
    public function __construct($id=null) {		
        if($id){
            $this->_booksCustom = new BooksCustom($id);			
        }else{
            $this->_booksCustom = new BooksCustom();			
        }
        return $this;
    }
       
    /**
     * valid param
     * 
     * @param array $param
     * @return boolean
     * @throws Exception
     */
    public function validate($param) {        
        try{
            if (!is_array($param)) {
                throw new Exception("Expected array as parameter , " . (is_object($param) ? get_class($param) : gettype($param)) . " found.");
            }                      
            if (!array_key_exists('id', $param)) {
                throw new Exception("Expected 'id' in array as parameter , " . (is_object($param['id']) ? get_class($param['id']) : gettype($param['id'])) . " found.");
            }			
            return TRUE;            
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
        }
    }
    
    public function getBook($informations, $user_id){
        try{
			$book = $this->_booksCustom->getBookByID($informations['id']);
		   //var_dump($book);die();
		   //die();
			if($book){
			   LogRepo::printLog('info', "Information of book #" . $book->id . " have just been fetched by account #{" . $user_id . "}.");
				$result = $this->prepareReponseAfterGet($book);
				return $result;
			}else{
				http_response_code(400);
				LogRepo::printLog('error', "book #" . $informations['id'] . " not found");
				$result = array('code'=>4000,'description'=>"book #" . $informations['id'] . " not found");
				echo json_encode($result, JSON_UNESCAPED_SLASHES);
				die(); 
			}
        }catch(Exception $e){
            LogRepo::printLog('error', $e->getMessage());
        }
    }
    
	public function editBook($informations, $user_id){
        try {              
			$valid = $this->validate($params,true);            
			if(!$valid){
				http_response_code(400);
				die(); 
			}
			$data = [];
			
			foreach($params as $p => $val){
				$data [$p] = $val;
			}
			// Get the user account with its ID
			$product = $this->_productCustom->model()->find($id);
			//var_dump($product->delete_status);die();
			if (!is_null($product)) {    					
					//var_dump($params);die();
					$product->dbSave($data);
					// Write in the log
					LogRepo::printLog('info', "Information of Product #{" . $id . "} has just been updated. Request inputs: ".var_export($params,true));
					//  prepare the response
					$result = $this->prepareReponseAfterPost($product);
					//  Return response
					return $result;
			} else {
					LogRepo::printLog('error', "Invalid attempt to update a non existing Product #{" . $id . "}. Returned code: 4006. Request inputs:".var_export($params,true));
					$result = array("code" => 4007, "description" => "Invalid object ID");
					return response()->json($result, 400);
			}
		} catch (Exception $ex) {
		
    }
    /**
     * Format of the response
     * 
     * @param array $param
     * @return array
     */
    public function prepareReponseAfterGet($book) {
        try {                    	        	
			$my_book['code'] = 200;
			$result = array(				                   
				'id'=>$book->id,
				'name'=>$book->name,
				'category'=>$book->category,
				'author'=>$book->author,
				'size'=>$book->size,                    
				'description'=>$book->description,
				'cover'=>$book->cover,
				'language'=>$book->language,
				'filepath'=>$book->filepath,
				'format'=>$book->format,
			);
            $my_book["item"] = $result;
            return $my_book;
        } catch (Exception $ex) {
            LogRepo::printLog('error', $ex->getMessage());
        }
    }
}
