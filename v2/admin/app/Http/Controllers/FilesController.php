<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Repositories\Util\LogRepository;
use App\Repositories\Custom\UserCustom;
use Validator;
use Route;

class FilesController extends Controller {

    public function __construct() {
        
    }

    /*
     *upload file
     */

    public function post(Request $request) {        
		try {
			$file = $request->file()['file'];
			$file_info =[];
			
			$rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
			$validator = Validator::make(array('file'=> $file), $rules);
			//var_dump(url('/'));die();
			//Request::url() == url('/');
			//$request->is('/') 
			//Route::getCurrentRoute()->uri()

			/**
			* instantiate Imagick 
			$im = new Imagick();

			$im->setResolution(300,300);
			$im->readimage('document.pdf[0]'); 
			$im->setImageFormat('jpeg');    
			$im->writeImage('thumb.jpg'); 
			$im->clear(); 
			$im->destroy();
			*
			*/
			if($validator->passes()){
				$destinationPath = "storage/app/uploads/books";
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$filename_without_ext = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
				//$filename = 'file'.'_'.date('YmdHms').'.'.$extension;
				$file_info = array(
					'file_name' => $filename_without_ext,
					'file_extension' => $extension,
					'file_path' => $destinationPath,
				);				
				//var_dump($filename);die(); , $filename_without_ext.'**'.date('YmdHms').'.'.$extension
				$upload_success = $file->move("../".$destinationPath,$filename);
				
				LogRepository::printLog('info', "File ".$filename_without_ext." has been uploaded");
				$result = $this->prepare_reponse_after_post($file_info);
				return $result;
			}else{
				echo $validator->errors();
			}			
			} catch (Exception $ex) {
				//var_dump($ex->getMessage()); die('ici');
				$file_info = array(
						'failed' => $true,
						'error_message' => $file->getErrorMessage() ,
					);
				$result = $this->prepare_reponse_after_post($file_info);
				LogRepository::printLog('error', $ex->getMessage());
			}
		/*
		$destinationPath = public_path() . "/uploads/books/";
        if ($request->hasFile('image')) {
            $extention = $request->file('image')->getClientOriginalExtension();
            $fileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
            $photo_name = url('/') . "/uploads/images/" . $fileName;
            $result = array("code" => 200, "file_name" => url('/') . "/uploads/images/" . $fileName);
            return response()->json($result, 200);
        } else {
            $result = "file not present";
            return response()->json($result, 400);
        }
		*/
    } 

	public function pdfToImg($file){  
		//$impath = "$path/images/$list[$i].png";
		if(!file_exists($file)){			
			// read page 1 
			$img = new imagick( $file.'[0]' ); 
			
			// convert to png 
			//$im->equalizeImage();
			$img->setImageFormat('png'); 
			
			//resize 
			//$img->resizeImage(300, 300);  
			
			//write image on server 
			$img->writeImage($impath); 
			$img->clear(); 
			$img->destroy();
		}
	}
	
	/*
	public function upload(Request $request) {
		try {
			$files = $request->file();
			$file_count = count($files);
			// start count how many uploaded
			$uploadcount = 0;
			$url=array();
			foreach($files as $file) {
				$rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
				$validator = Validator::make(array('file'=> $file), $rules);
				if($validator->passes()){
					$destinationPath = '../uploads';
					$filename = $file->getClientOriginalName();
					$extention = $file->getClientOriginalExtension();
					 
					$matches = preg_split("/[\s.]+/", $filename);
					//preg_match('/.$/', $filename, $matches);
					//var_dump($matches);die('ici');
					$extension=$matches[1];
					
					//$filename = 'file'.'_'.date('YmdHms').'.'.$extension;
					$url[]='/uploads/'.$filename;				
					$upload_success = $file->move($destinationPath, $filename.'_'.date('YmdHms').'.'.$extension);
					LogRepository::printLog('info', "File ".$filename." has been uploaded");
					$uploadcount ++;
				}
			}
			$result = $this->prepare_reponse_after_post($url);
			return $result;
			} catch (Exception $ex) {
				var_dump($ex->getMessage()); die('ici');
				LogRepository::printLog('error', $ex->getMessage());
			}
    }*/

    public function prepare_reponse_after_post($file_info) {
        try {
			$result = [
				'code' =>200,
				'file_info' => $file_info
			];
            return $result;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
	
}
