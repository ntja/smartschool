<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;

class Book extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'books';
    public $timestamps = false;
    protected $fillable = [
        'name','author','size','description','language','cover','filepath','format','category'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function __construct() {           
        return $this;
    }
        
    public function bookCategory(){
        return $this->belongsTo('App\Models\book','category');
    }    

    public function dbSave($params) {
		//var_dump($params);die();
        try {            
            if (!is_array($params)){
				throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
			}                

            if (array_key_exists("name", $params)) {
                if (!is_string($params['name'])) {
                    throw new Exception("Expected String for key (name), " . (is_object($params['name']) ? get_class($params['name']) : gettype($params['name'])) . ' found.');
                }
                $this->name = $params['name'];
            }
            if (array_key_exists("filepath", $params)) {
                if (!is_string($params['filepath'])) {
                    throw new Exception("Expected String for key (filepath), " . (is_object($params['filepath']) ? get_class($params['filepath']) : gettype($params['filepath'])) . ' found.');
                }
                $this->filepath = $params['filepath'];
            }
           
            if (array_key_exists("author", $params)) {
                //throw new Exception("Expected key (author) in parameter array.");
                if (!is_null($params['author'])) {
                    if (!is_string($params['author'])) {
                        throw new Exception("Expected String for key (author), " . (is_object($params['author']) ? get_class($params['author']) : gettype($params['author'])) . ' found.');
                    }
                }                
                $this->author = $params['author'];
            }
            if (array_key_exists("size", $params)) {
                if (!is_null($params['size'])) {
                    if (!is_string($params['size'])) {
                        throw new Exception("Expected String for key (photo), " . (is_object($params['size']) ? get_class($params['size']) : gettype($params['size'])) . ' found.');
                    }
                }                
                $this->size = $params['size'];
            }
            if (array_key_exists("description", $params)) {
                if (!is_null($params['description'])) {
                    if (!is_string($params['description'])) {
                        throw new Exception("Expected String for key (description), " . (is_object($params['description']) ? get_class($params['description']) : gettype($params['description'])) . ' found.');
                    }
                }                
                $this->description = $params['description'];
            }
            if (array_key_exists("language", $params)) {
                if (!is_null($params['cover'])) {
                    if (!is_string($params['language'])) {
                        throw new Exception("Expected String for key (language), " . (is_object($params['language']) ? get_class($params['language']) : gettype($params['language'])) . ' found.');
                    }
                }                
                $this->language = $params['language'];
            }
            if (array_key_exists("cover", $params)) {
                //throw new Exception("Expected key (cover) in parameter array.");
                if (!is_null($params['cover'])) {
                    if (!is_string($params['cover'])) {
                        throw new Exception("Expected String for key (cover), " . (is_object($params['cover']) ? get_class($params['cover']) : gettype($params['cover'])) . ' found.');
                    }
                }                
                $this->cover = $params['cover'];
            }
            if (array_key_exists("format", $params)) {
                //throw new Exception("Expected key (format) in parameter array.");
                if (!is_null($params['format'])) {
                    if (!is_string($params['format'])) {
                        throw new Exception("Expected String for key (format), " . (is_object($params['format']) ? get_class($params['format']) : gettype($params['format'])) . ' found.');
                    }
                }                
                $this->format = $params['format'];
            }            

            if (array_key_exists("date_created", $params)) {
                //throw new Exception("Expected key (date_created) in parameter array.");
                if (!is_string($params['date_created'])) {
                    throw new Exception("Expected String for key (date_created), " . (is_object($params['date_created']) ? get_class($params['date_created']) : gettype($params['date_created'])) . ' found.');
                }
                $this->date_created = $params['date_created'];
            }
            
            if (array_key_exists("category", $params)) {
                //throw new Exception("Expected key (category) in parameter array.");
                if (!is_numeric($params['category'])) {
                    throw new Exception("Expected Numeric for key (category), " . (is_object($params['category']) ? get_class($params['category']) : gettype($params['category'])) . ' found.');
                }
                $this->category = $params['category'];
            }            
						
			//var_dump($params);
			//die();
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }

    public function getBooks($params,$query = null) {
        try {
            //var_dump($params);die();
            if (!is_array($params)){
                throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
            }
            
            if (!array_key_exists("limit", $params)){
                throw new Exception("Expected key (limit) in parameter array.");
            }
            
            if (!array_key_exists("category", $params)){
                throw new Exception("Expected key (category) in parameter  array.");
            }

            $result = null;          
            $limit = intval($params['limit']);        
            //var_dump($role);die();    

            $category = $params['category'];
            $select = DB::table('books')
                    ->join('book_categories', 'book_categories.id', '=', 'books.category')
                    ->select('books.*', 'book_categories.name as category_name')
                    //->skip(0)
                    ->where('books.delete_status', '=', '0');
                    //->take($limit);
            if ($category) {
                $select = $select
                        ->where('category', '=', $category);
            }                                                
            //var_dump($select);die();       

            $rows = $select->orderBy('id','DESC')->simplePaginate($limit);
            //var_dump($rows);die();       
            if (!count($rows)) {
                return false;
            }
            $result = $rows;

            return $result;
        } catch (Exception $ex) {

            LogRepository::printLog('error', $ex->getMessage());
        }
    }
}