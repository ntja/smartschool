<?php

namespace App\Http\Controllers\Books;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Repositories\Util\LogRepository;
use DB;
use File;
use Illuminate\Support\Str;


class FromStorageController extends Controller {

    public function __construct() {
        
    }

    /*
     *upload file
     */

    public function getNonUploadedCategories($storage) {
		try{
			$course_categories = DB::table('book_categories')->select('name')->get()->toArray();
			//$books = DB::table('books')->select('name')->get()->toArray();
			$category_titles = [];
			$extract_cat_titles = [];
            foreach ($course_categories as $category) {
                //var_dump($category);die();
                $category_titles[] = $category->name;
            }
			//var_dump($category_titles);die();
			$directories = \File::directories('storage/books');
			//var_dump($directories);die();
            foreach ($directories as $dir){
                $explode_dir = explode(DIRECTORY_SEPARATOR, $dir);
                $title = end($explode_dir);
                if(in_array($title, $category_titles)){
                    continue;
                }
                $extract_cat_titles[] = $title;                
            }
            //var_dump($extract_cat_titles);die();
            //end($array);           
            return $extract_cat_titles;
		} catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
            echo $ex->getMessage();
			die();
        }        
    }
    
    public function getBooks($path) {
		try{
			$categories = $this->getNonUploadedCategories($path);
			$array_files = [];			
			DB::beginTransaction();
			foreach ($categories as $category){
				/**/				
				$cat_id = DB::table('book_categories')->insertGetId(
					array('name' => $category)
				);
				
				$books = \File::allFiles('storage/books/'.$category);
				foreach($books as $book){
					//$cover = $book->getRealPath().''.$book					
					$arr = explode(DIRECTORY_SEPARATOR,$book->getRealPath());
					$arr_2 = explode(DIRECTORY_SEPARATOR,$book->getPathname());
					array_pop($arr);
					array_pop($arr_2);
					$cover = implode(DIRECTORY_SEPARATOR,$arr). DIRECTORY_SEPARATOR .'cover'. DIRECTORY_SEPARATOR .Str::slug(explode('.pdf', $book->getFilename())[0]).'.jpg';
					$cover_rel_link = implode(DIRECTORY_SEPARATOR,$arr_2). DIRECTORY_SEPARATOR .'cover'. DIRECTORY_SEPARATOR .Str::slug(explode('.pdf', $book->getFilename())[0]).'.jpg';
					//var_dump($cover_rel_link);die();
					$this->extractCoverFromPdf($book->getRealPath().'[0]',$cover);
					LogRepository::printLog('info', var_export($book->getFilename()[0],true));					
					$book_id = DB::table('books')->insertGetId(
						[
							'name' =>  explode('.pdf', $book->getFilename())[0],
							'slug_name' => Str::slug(explode('.pdf', $book->getFilename())[0]),
							'category' => $cat_id,
							'size' => $book->getSize(),
							'cover' => $cover_rel_link,
							'filepath' => $book->getPathname(),
						]
					); 
					$x = [
						'path' => $book->getPathname(),
						'file_name' => $book->getFilename(),
						'extension' => $book->getExtension(),
						'size' => $book->getSize()
					];
					$array_files[] = $x;
				}
				$result['books'] = $array_files;
			}
			//
			DB::commit();
            return isset($result)? $result:'No book to Upload';
            //var_dump($result);die();            
        } catch (Exception $ex) {
            DB::rollback();
			LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
            echo $ex->getMessage();
			die();
        }
		
    }
        
	public function extractCoverFromPdf($filepath, $savepath=__DIR__ . DIRECTORY_SEPARATOR .'cover.jpg'){
		try{
			$imagick = new \Imagick($filepath);
			$imagick->setResolution(300, 300);
			//$imagick->readImage($filepath);
			//reduce the dimensions - scaling will lead to black color in transparent regions
			$imagick->scaleImage(800,0);
			$imagick->cropImage(900,850, 0,100);
			//set new format
			$imagick->setImageFormat('jpeg');
			$imagick->setImageCompression(\Imagick::COMPRESSION_JPEG);
			$imagick->setCompressionQuality(100);
			//$imagick->setImageColorspace(4);
			//$imagick->setImageBackgroundColor('white');		
			//$imagick = $imagick->flattenImages();
			$imagick->trimImage(0);
			$imagick->writeImage($savepath); 
			//$output = $imagick->getimageblob();
			//$outputtype = $imagick->getFormat();
			//header("content-type:$outputtype");
			//print_r($output);die();		
			$imagick->destroy();
		}catch(Exception $ex){
			LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
            echo $ex->getMessage();
			die();
		}		
	}
	
    public function post(Request $request) {        
        try {
			return $this->getBooks('storage/books');
			//$contents = \Storage::get('thinking-skills.pdf');
            //$file = File::get('storage/books/thinking-skills.pdf');
			//$path = __DIR__ . DIRECTORY_SEPARATOR .'stockholm-school-of-economics.pdf[0]';
			//$this->extractCoverFromPdf($path);
            //$lessons = $this->getVideosOfLessons();            
            //return $lessons;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
			die();
        }         
    }
}
