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

	public function uploadImage(Request $request) {
		try {
			//$s3 = \Storage::disk('s3');
			$destinationPath = public_path() . DIRECTORY_SEPARATOR ."uploads". DIRECTORY_SEPARATOR . "images". DIRECTORY_SEPARATOR;
			$images = $request->only('image')['image'];
			//var_dump($images);die();
			$old_image = $request->only('old_image')["old_image"];
			//var_dump($images);die();
			if(!is_array($images)){
				$this->validate($request, [
					'image' => 'required|image|mimes:jpeg,jpg,JPG,png,gif,svg|max:2048',
				]);
			}
			if($images){
				if(is_array($images)){
					//die("here");
					$file_names = array();
					for($i=0; $i<count($images); $i++){
						$image = $images[$i];
						$extension = $images[$i]->getClientOriginalExtension();
						$original_name = $images[$i]->getClientOriginalName();
						$photo_name = sha1(time() . time().$original_name) . ".{$extension}";
						$file_name =  "uploads". DIRECTORY_SEPARATOR . "images". DIRECTORY_SEPARATOR . $photo_name;
						$image->move($destinationPath, $file_name);
						$file_names[] = $file_name;
					}
					$result = array("code" => 200, "file_name" => $file_names);
					return response()->json($result, 200);
				}elseif ($request->hasFile('image')) {
					$image = $request->file('image');
					if($image->isValid()) {
						$extension = $image->getClientOriginalExtension();
						$original_name = $image->getClientOriginalName();
						$photo_name = sha1(time() . time().$original_name) . ".{$extension}";
						$file_name = "uploads". DIRECTORY_SEPARATOR . "images". DIRECTORY_SEPARATOR . $photo_name;
						$image->move($destinationPath, $file_name);
						$result = array("code" => 200, "file_name" => $file_name);
						if($old_image){
							$file = public_path() . DIRECTORY_SEPARATOR .$old_image;
							//var_dump($file);die();
							if($file){
								File::delete($file);
							}
						}
						return response()->json($result, 200);
					}
				}else {
					$result = "file not found";
					return response()->json($result, 400);
				}
			}
		} catch (Exception $ex) {
			LogRepo::printLog('error', $ex->getMessage());
			$result = "Validation failed";
			return response()->json($result, 400);
			//die();
		}
	}

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
