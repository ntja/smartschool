<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;

class Course extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'courses';
    public $timestamps = false;
    protected $fillable = [
        'name','shortname','language','largeicon','photo','previewlink','shortdescription','smallicon','smalliconhover','istranslate','directorypath','aboutthecourse','targetaudience','faq','coursesyllabus','courseformat','suggestedreadings','estimatedclassworkload','recommendedbackground','instructor','school','category'
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
        
    public function courseCategory(){
        return $this->belongsTo('App\Models\Course','CourseCategory');
    }
    public function school(){
        return $this->belongsTo('App\Models\School','CourseCategory');
    }

    public function dbSave($params) {
		//var_dump($params);die();
        try {            
            if (!is_array($params)){
				throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
			}                

            if (array_key_exists("name", $params)) {
                //throw new Exception("Expected key (name) in parameter array.");
                if (!is_string($params['name'])) {
                    throw new Exception("Expected String for key (name), " . (is_object($params['name']) ? get_class($params['name']) : gettype($params['name'])) . ' found.');
                }
                $this->name = $params['name'];
            }
            if (array_key_exists("shortname", $params)) {
                //throw new Exception("Expected key (shortname) in parameter array.");
                if (!is_string($params['shortname'])) {
                    throw new Exception("Expected String for key (shortname), " . (is_object($params['shortname']) ? get_class($params['shortname']) : gettype($params['shortname'])) . ' found.');
                }
                $this->shortname = $params['shortname'];
            }

            if (array_key_exists("language", $params)) {
                //throw new Exception("Expected key (language) in parameter array.");
                if (!is_string($params['language'])) {
                    throw new Exception("Expected String for key (language), " . (is_object($params['language']) ? get_class($params['language']) : gettype($params['language'])) . ' found.');
                }
                $this->language = $params['language'];
            }
            if (array_key_exists("largeicon", $params)) {
                //throw new Exception("Expected key (largeicon) in parameter array.");
                if (!is_null($params['largeicon'])) {
                    if (!is_string($params['largeicon'])) {
                        throw new Exception("Expected String for key (largeicon), " . (is_object($params['largeicon']) ? get_class($params['largeicon']) : gettype($params['largeicon'])) . ' found.');
                    }
                }                
                $this->largeicon = $params['largeicon'];
            }
            if (array_key_exists("photo", $params)) {
                //throw new Exception("Expected key (photo) in parameter array.");
                if (!is_null($params['photo'])) {
                    if (!is_string($params['photo'])) {
                        throw new Exception("Expected String for key (photo), " . (is_object($params['photo']) ? get_class($params['photo']) : gettype($params['photo'])) . ' found.');
                    }
                }                
                $this->photo = $params['photo'];
            }
            if (array_key_exists("previewlink", $params)) {
                //throw new Exception("Expected key (previewlink) in parameter array.");
                if (!is_null($params['previewlink'])) {
                    if (!is_string($params['previewlink'])) {
                        throw new Exception("Expected String for key (previewlink), " . (is_object($params['previewlink']) ? get_class($params['previewlink']) : gettype($params['previewlink'])) . ' found.');
                    }
                }                
                $this->previewlink = $params['previewlink'];
            }
            if (array_key_exists("shortdescription", $params)) {
                if (!is_string($params['shortdescription'])) {
                    throw new Exception("Expected String for key (shortdescription), " . (is_object($params['shortdescription']) ? get_class($params['shortdescription']) : gettype($params['shortdescription'])) . ' found.');
                }
                $this->shortdescription = $params['shortdescription'];
            }
            if (array_key_exists("start_date", $params)) {
				if (!is_null($params['start_date'])) {
					if (!is_string($params['start_date'])) {
						throw new Exception("Expected String for key (start_date), " . (is_object($params['start_date']) ? get_class($params['start_date']) : gettype($params['start_date'])) . ' found.');
					}
				}
                
                $this->start_date = $params['start_date'];
            }
            if (array_key_exists("smallicon", $params)) {
                if (!is_null($params['smallicon'])) {
                    if (!is_string($params['smallicon'])) {
                        throw new Exception("Expected String for key (smallicon), " . (is_object($params['smallicon']) ? get_class($params['smallicon']) : gettype($params['smallicon'])) . ' found.');
                    }
                }                
                $this->smallicon = $params['smallicon'];
            }
            if (array_key_exists("smalliconhover", $params)) {
                if (!is_null($params['smalliconhover'])) {
                    if (!is_string($params['smalliconhover'])) {
                        throw new Exception("Expected String for key (smalliconhover), " . (is_object($params['smalliconhover']) ? get_class($params['smalliconhover']) : gettype($params['smalliconhover'])) . ' found.');
                    }
                }                
                $this->smalliconhover = $params['smalliconhover'];
            }            

            if (array_key_exists("istranslate", $params)) {
                //throw new Exception("Expected key (istranslate) in parameter array.");
                if (!is_numeric($params['istranslate'])) {
                    throw new Exception("Expected Numeric for key (istranslate), " . (is_object($params['istranslate']) ? get_class($params['istranslate']) : gettype($params['istranslate'])) . ' found.');
                }
                $this->istranslate = $params['istranslate'];
            }
            if (array_key_exists("directorypath", $params)) {
                //throw new Exception("Expected key (directorypath) in parameter array.");
                if (!is_null($params['directorypath'])) {
                    if (!is_string($params['directorypath'])) {
                        throw new Exception("Expected String for key (directorypath), " . (is_object($params['directorypath']) ? get_class($params['directorypath']) : gettype($params['directorypath'])) . ' found.');
                    }
                }                
                $this->directorypath = $params['directorypath'];
            }
            if (array_key_exists("aboutthecourse", $params)) {
                //throw new Exception("Expected key (aboutthecourse) in parameter array.");
                if (!is_null($params['aboutthecourse'])) {
                    if (!is_string($params['aboutthecourse'])) {
                        throw new Exception("Expected String for key (aboutthecourse), " . (is_object($params['aboutthecourse']) ? get_class($params['aboutthecourse']) : gettype($params['aboutthecourse'])) . ' found.');
                    }
                }                
                $this->aboutthecourse = $params['aboutthecourse'];
            }
            if (array_key_exists("targetaudience", $params)) {
                //throw new Exception("Expected key (targetaudience) in parameter array.");
                if (!is_null($params['targetaudience'])) {
                    if (!is_string($params['targetaudience'])) {
                        throw new Exception("Expected String for key (targetaudience), " . (is_object($params['targetaudience']) ? get_class($params['targetaudience']) : gettype($params['targetaudience'])) . ' found.');
                    }
                }                
                $this->targetaudience = $params['targetaudience'];
            }
            if (array_key_exists("faq", $params)) {
                //throw new Exception("Expected key (faq) in parameter array.");
                if (!is_null($params['faq'])) {
                    if (!is_string($params['faq'])) {
                        throw new Exception("Expected String for key (faq), " . (is_object($params['faq']) ? get_class($params['faq']) : gettype($params['faq'])) . ' found.');
                    }
                }                
                $this->faq = $params['faq'];
            }
            if (array_key_exists("coursesyllabus", $params)) {
                //throw new Exception("Expected key (coursesyllabus) in parameter array.");
                if (!is_null($params['coursesyllabus'])) {
                    if (!is_string($params['coursesyllabus'])) {
                        throw new Exception("Expected String for key (coursesyllabus), " . (is_object($params['coursesyllabus']) ? get_class($params['coursesyllabus']) : gettype($params['coursesyllabus'])) . ' found.');
                    }
                }                
                $this->coursesyllabus = $params['coursesyllabus'];
            }
            if (array_key_exists("courseformat", $params)) {
                //throw new Exception("Expected key (courseformat) in parameter array.");
                if (!is_null($params['courseformat'])) {
                    if (!is_string($params['courseformat'])) {
                        throw new Exception("Expected String for key (courseformat), " . (is_object($params['courseformat']) ? get_class($params['courseformat']) : gettype($params['courseformat'])) . ' found.');
                    }
                }                
                $this->courseformat = $params['courseformat'];
            }
            if (array_key_exists("suggestedreadings", $params)) {
                //throw new Exception("Expected key (suggestedreadings) in parameter array.");
                if (!is_null($params['suggestedreadings'])) {
                    if (!is_string($params['suggestedreadings'])) {
                        throw new Exception("Expected String for key (suggestedreadings), " . (is_object($params['suggestedreadings']) ? get_class($params['suggestedreadings']) : gettype($params['suggestedreadings'])) . ' found.');
                    }
                }                
                $this->suggestedreadings = $params['suggestedreadings'];
            }
            if (array_key_exists("estimatedclassworkload", $params)) {
                //throw new Exception("Expected key (estimatedclassworkload) in parameter array.");
                if (!is_null($params['estimatedclassworkload'])) {
                    if (!is_string($params['estimatedclassworkload'])) {
                        throw new Exception("Expected String for key (estimatedclassworkload), " . (is_object($params['estimatedclassworkload']) ? get_class($params['estimatedclassworkload']) : gettype($params['estimatedclassworkload'])) . ' found.');
                    }
                }                
                $this->estimatedclassworkload = $params['estimatedclassworkload'];
            }
            if (array_key_exists("recommendedbackground", $params)) {
                //throw new Exception("Expected key (recommendedbackground) in parameter array.");
                if (!is_null($params['recommendedbackground'])) {
                    if (!is_string($params['recommendedbackground'])) {
                        throw new Exception("Expected String for key (recommendedbackground), " . (is_object($params['recommendedbackground']) ? get_class($params['recommendedbackground']) : gettype($params['recommendedbackground'])) . ' found.');
                    }
                }                
                $this->recommendedbackground = $params['recommendedbackground'];
            }
            if (array_key_exists("date_created", $params)) {
                //throw new Exception("Expected key (date_created) in parameter array.");
                if (!is_string($params['date_created'])) {
                    throw new Exception("Expected String for key (date_created), " . (is_object($params['date_created']) ? get_class($params['date_created']) : gettype($params['date_created'])) . ' found.');
                }
                $this->date_created = $params['date_created'];
            }
            if (array_key_exists("instructor", $params)) {
                if (!is_numeric($params['instructor'])) {
                    throw new Exception("Expected Numeric for key (instructor), " . (is_object($params['instructor']) ? get_class($params['instructor']) : gettype($params['instructor'])) . ' found.');
                }
                $this->instructor = $params['instructor'];
            }

            if (array_key_exists("school", $params)) {
                //throw new Exception("Expected key (school) in parameter array.");
                if (!is_null($params['school'])) {
                    if (!is_numeric($params['school'])) {
                        throw new Exception("Expected Numeric for key (school), " . (is_object($params['school']) ? get_class($params['school']) : gettype($params['school'])) . ' found.');
                    }
                }                
                $this->school = $params['school'];
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

    public function getCourses($params, $connected_user, $account=null) {
        try {
            //var_dump($params);die();
            if (!is_array($params)){
                throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
            }
            
            if (!array_key_exists("limit", $params)){
                throw new Exception("Expected key (limit) in parameter array.");
            }
            
            if (!array_key_exists("status", $params)){
                throw new Exception("Expected key (status) in parameter  array.");
            }

            $result = null;          
            $limit = intval($params['limit']);        
            //var_dump($role);die();    
            if($connected_user->getRole() == "LEARNER" || $connected_user->getRole() == "PARENT"|| $connected_user->getRole() == "GUEST"){
                $select = DB::table('courses')
                    ->join('course_categories', 'course_categories.id', '=', 'courses.category')
                    ->join('accounts', 'accounts.id', '=', 'courses.instructor')
                    ->select('courses.*', 'course_categories.name as category_name','accounts.first_name','accounts.last_name')
                    //->skip(0)                        
                    ->where('courses.delete_status', '=', '0')->where('status', '=', "PUBLISHED"); 
                    //->take($limit);   
            }else{
                $status = $params['status'];
                $select = DB::table('courses')
                        ->join('course_categories', 'course_categories.id', '=', 'courses.category')
                        ->join('accounts', 'accounts.id', '=', 'courses.instructor')
                        ->select('courses.*', 'course_categories.name as category_name','accounts.first_name','accounts.last_name')
                        //->skip(0)
                        ->where('courses.delete_status', '=', '0');
                        //->take($limit);
                if ($status) {
                    $select = $select
                            ->where('status', '=', $status);
                }                        
            }             
            if($account){                
                $select = $select
                ->where('instructor', '=', $account);
                //->take($limit);    
            }
            
            $rows = $select->orderBy('id','DESC')->paginate($limit);
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

    public function search($params){        
        try{
            if (!is_array($params)){
                throw new Exception("Expected Array as parameter, " . (is_object($params) ? get_class($params) : gettype($params)) . ' given.');
            }
            
            if (!array_key_exists("query", $params)){
                throw new Exception("Expected key (query) in parameter array.");
            }
            
            if (!array_key_exists("limit", $params)){
                throw new Exception("Expected key (limit) in parameter array.");
            }

            $result = null;            
            $limit = intval($params['limit']);
            $query = '%'.$params['query'].'%';
            $select = DB::table('courses')
				->join('course_categories','course_categories.id','=','courses.category')
				->join('accounts', 'accounts.id', '=', 'courses.instructor')
                ->select('courses.*', 'course_categories.name as category_name','course_categories.shortname as category_shortname','course_categories.description as category_description','accounts.first_name', 'accounts.last_name')
                ->where('courses.delete_status', '=', '0')
				->where('courses.status', '=', 'PUBLISHED')
                ->where(function ($q) use ($query) {
                    $q->where('courses.name', 'like', $query)
                            ->orWhere('courses.shortname', 'like', $query)
                            ->orWhere('courses.shortdescription', 'like',  $query)
                            ->orWhere('courses.aboutthecourse', 'like',  $query)
                            ->orWhere('courses.faq', 'like',  $query)
                            ->orWhere('courses.coursesyllabus', 'like',  $query)
                            ->orWhere('courses.suggestedreadings', 'like',  $query)
                            ->orWhere('courses.recommendedbackground', 'like',  $query)
                            ->orWhere('course_categories.name', 'like',  $query)
                            ->orWhere('course_categories.shortname', 'like',  $query)
                            ->orWhere('course_categories.description', 'like',  $query);
                });
                    
            $rows = $select->orderBy('courses.id','DESC')->paginate($limit);
            if (!count($rows)) {
                return false;
            }
            $result = $rows;

            return $result;            
        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }
    }
}