<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Database\Eloquent\Model as Eloquent;
use DB;
use Exception;
use App\Repositories\Util\LogRepository;
use Illuminate\Support\Str;

class Course extends Authenticatable{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $table = 'courses';
    public $timestamps = false;
    protected $fillable = [
        'name','shortname','language','largeicon','photo','previewlink','shortdescription','smallicon','smalliconhover','istranslate','directorypath',
		'aboutthecourse','targetaudience','faq','coursesyllabus','courseformat','suggestedreadings','estimatedclassworkload','recommendedbackground',
		'instructor','school','category','expected_learning','start_date','expected_duration','expected_duration_unit'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'delete_status'
    ];

    public function __construct() {           
        return $this;
    }
        
    public function courseCategory(){
        return $this->belongsTo('App\Models\CourseCategory','category');
    }
    public function school(){
        return $this->belongsTo('App\Models\School');
    }
	
	// 1 to * relationship with account table
	public function account(){
        return $this->belongsTo('App\Models\Account', 'instructor');
    }
	
	// 1 to * relationship with section table
	public function section(){
        return $this->hasMany('App\Models\CourseSection', 'course');
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
            if (array_key_exists("shortname", $params)) {
                if (!is_string($params['shortname'])) {
                    throw new Exception("Expected String for key (shortname), " . (is_object($params['shortname']) ? get_class($params['shortname']) : gettype($params['shortname'])) . ' found.');
                }
                $this->shortname = Str::slug($params['shortname']);
            }

            if (array_key_exists("language", $params)) {
                if (!is_string($params['language'])) {
                    throw new Exception("Expected String for key (language), " . (is_object($params['language']) ? get_class($params['language']) : gettype($params['language'])) . ' found.');
                }
                $this->language = $params['language'];
            }
            if (array_key_exists("largeicon", $params)) {
                if (!is_null($params['largeicon'])) {
                    if (!is_string($params['largeicon'])) {
                        throw new Exception("Expected String for key (largeicon), " . (is_object($params['largeicon']) ? get_class($params['largeicon']) : gettype($params['largeicon'])) . ' found.');
                    }
					$this->largeicon = $params['largeicon'];
                }
            }
            if (array_key_exists("photo", $params)) {
                if (!is_null($params['photo'])) {
                    if (!is_string($params['photo'])) {
                        throw new Exception("Expected String for key (photo), " . (is_object($params['photo']) ? get_class($params['photo']) : gettype($params['photo'])) . ' found.');
                    }
                }                
                $this->photo = $params['photo'];
            }
            if (array_key_exists("previewlink", $params)) {
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
					$this->start_date = $params['start_date'];
				}
            }
			if (array_key_exists("expected_duration", $params)) {
				if (!is_null($params['expected_duration'])) {
					if (!is_string($params['expected_duration'])) {
						throw new Exception("Expected String for key (expected_duration), " . (is_object($params['expected_duration']) ? get_class($params['expected_duration']) : gettype($params['expected_duration'])) . ' found.');
					}
					$this->expected_duration = $params['expected_duration'];
				}
            }
			if (array_key_exists("expected_duration_unit", $params)) {
				if (!is_null($params['expected_duration_unit'])) {
					if (!is_string($params['expected_duration_unit'])) {
						throw new Exception("Expected String for key (expected_duration_unit), " . (is_object($params['expected_duration_unit']) ? get_class($params['expected_duration_unit']) : gettype($params['expected_duration_unit'])) . ' found.');
					}
					$this->expected_duration_unit = $params['expected_duration_unit'];
				}
            }
			if (array_key_exists("end_date", $params)) {
				if (!is_null($params['end_date'])) {
					if (!is_string($params['end_date'])) {
						throw new Exception("Expected String for key (end_date), " . (is_object($params['end_date']) ? get_class($params['end_date']) : gettype($params['end_date'])) . ' found.');
					}
					$this->end_date = $params['end_date'];
				}
            }
            if (array_key_exists("smallicon", $params)) {
                if (!is_null($params['smallicon'])) {
                    if (!is_string($params['smallicon'])) {
                        throw new Exception("Expected String for key (smallicon), " . (is_object($params['smallicon']) ? get_class($params['smallicon']) : gettype($params['smallicon'])) . ' found.');
                    }
					$this->smallicon = $params['smallicon'];
                }
            }
            if (array_key_exists("smalliconhover", $params)) {
                if (!is_null($params['smalliconhover'])) {
                    if (!is_string($params['smalliconhover'])) {
                        throw new Exception("Expected String for key (smalliconhover), " . (is_object($params['smalliconhover']) ? get_class($params['smalliconhover']) : gettype($params['smalliconhover'])) . ' found.');
                    }
					$this->smalliconhover = $params['smalliconhover'];
                }
            }            

            if (array_key_exists("istranslate", $params)) {
                if (!is_numeric($params['istranslate'])) {
                    throw new Exception("Expected Numeric for key (istranslate), " . (is_object($params['istranslate']) ? get_class($params['istranslate']) : gettype($params['istranslate'])) . ' found.');
                }
                $this->istranslate = $params['istranslate'];
            }
            if (array_key_exists("directorypath", $params)) {
                if (!is_null($params['directorypath'])) {
                    if (!is_string($params['directorypath'])) {
                        throw new Exception("Expected String for key (directorypath), " . (is_object($params['directorypath']) ? get_class($params['directorypath']) : gettype($params['directorypath'])) . ' found.');
                    }
					$this->directorypath = $params['directorypath'];
                }
            }
            if (array_key_exists("aboutthecourse", $params)) {
                if (!is_null($params['aboutthecourse'])) {
                    if (!is_string($params['aboutthecourse'])) {
                        throw new Exception("Expected String for key (aboutthecourse), " . (is_object($params['aboutthecourse']) ? get_class($params['aboutthecourse']) : gettype($params['aboutthecourse'])) . ' found.');
                    }
					$this->aboutthecourse = $params['aboutthecourse'];
                }
            }
            if (array_key_exists("targetaudience", $params)) {
                if (!is_null($params['targetaudience'])) {
                    if (!is_string($params['targetaudience'])) {
                        throw new Exception("Expected String for key (targetaudience), " . (is_object($params['targetaudience']) ? get_class($params['targetaudience']) : gettype($params['targetaudience'])) . ' found.');
                    }
					$this->targetaudience = $params['targetaudience'];
                }
            }
            if (array_key_exists("faq", $params)) {
                if (!is_null($params['faq'])) {
                    if (!is_string($params['faq'])) {
                        throw new Exception("Expected String for key (faq), " . (is_object($params['faq']) ? get_class($params['faq']) : gettype($params['faq'])) . ' found.');
                    }
					$this->faq = $params['faq'];
                }
            }
            if (array_key_exists("coursesyllabus", $params)) {
                if (!is_null($params['coursesyllabus'])) {
                    if (!is_string($params['coursesyllabus'])) {
                        throw new Exception("Expected String for key (coursesyllabus), " . (is_object($params['coursesyllabus']) ? get_class($params['coursesyllabus']) : gettype($params['coursesyllabus'])) . ' found.');
                    }
					$this->coursesyllabus = $params['coursesyllabus'];
                }
            }
            if (array_key_exists("courseformat", $params)) {
                if (!is_null($params['courseformat'])) {
                    if (!is_string($params['courseformat'])) {
                        throw new Exception("Expected String for key (courseformat), " . (is_object($params['courseformat']) ? get_class($params['courseformat']) : gettype($params['courseformat'])) . ' found.');
                    }
					$this->courseformat = $params['courseformat'];
                }
            }
            if (array_key_exists("suggestedreadings", $params)) {
                if (!is_null($params['suggestedreadings'])) {
                    if (!is_string($params['suggestedreadings'])) {
                        throw new Exception("Expected String for key (suggestedreadings), " . (is_object($params['suggestedreadings']) ? get_class($params['suggestedreadings']) : gettype($params['suggestedreadings'])) . ' found.');
                    }
					$this->suggestedreadings = $params['suggestedreadings'];
                }
            }
            if (array_key_exists("estimatedclassworkload", $params)) {
                if (!is_null($params['estimatedclassworkload'])) {
                    if (!is_string($params['estimatedclassworkload'])) {
                        throw new Exception("Expected String for key (estimatedclassworkload), " . (is_object($params['estimatedclassworkload']) ? get_class($params['estimatedclassworkload']) : gettype($params['estimatedclassworkload'])) . ' found.');
                    }
					$this->estimatedclassworkload = $params['estimatedclassworkload'];
                }
            }
            if (array_key_exists("recommendedbackground", $params)) {
                if (!is_null($params['recommendedbackground'])) {
                    if (!is_string($params['recommendedbackground'])) {
                        throw new Exception("Expected String for key (recommendedbackground), " . (is_object($params['recommendedbackground']) ? get_class($params['recommendedbackground']) : gettype($params['recommendedbackground'])) . ' found.');
                    }
					$this->recommendedbackground = $params['recommendedbackground'];
                }
            }
            if (array_key_exists("date_created", $params)) {
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
                if (!is_null($params['school'])) {
                    if (!is_numeric($params['school'])) {
                        throw new Exception("Expected Numeric for key (school), " . (is_object($params['school']) ? get_class($params['school']) : gettype($params['school'])) . ' found.');
                    }
					$this->school = $params['school'];
                }
            }
            if (array_key_exists("category", $params)) {
                if (!is_numeric($params['category'])) {
                    throw new Exception("Expected Numeric for key (category), " . (is_object($params['category']) ? get_class($params['category']) : gettype($params['category'])) . ' found.');
                }
                $this->category = $params['category'];
            }            
			//var_dump($params);die();
            return $this->save();
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
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
			$category = array_key_exists("category", $params)?$params['category']:null;
            //var_dump($role);die();  
			
            if($connected_user->getRole() == "LEARNER" || $connected_user->getRole() == "PARENT"|| $connected_user->getRole() == "GUEST"){               
				$select = Course::with(
					[
						'account'=> function ($query) {
							$query->select('id','first_name','last_name');
						},
						'courseCategory', 
						'section'])
					->where('courses.delete_status', '=', '0')
					->where('courses.status', '=', "PUBLISHED");
            }else{
				//die('here');
                $status = $params['status'];				
				$select = Course::with(
				[
					'account'=> function ($query) {
						$query->select('id','first_name','last_name');
					},
					'courseCategory',
					'section'])
				->where('courses.delete_status', '=', '0');
                if ($status) {
                    $select = $select
                            ->where('status', '=', $status);
                }                        
            }             
            if($account){                
                $select = $select
                ->where('instructor', '=', $account);
            }
			if($category){                
                $select = $select
                ->where('category', '=', $category);
            }
            
            $rows = $select->orderBy('id','DESC')->paginate($limit);
            //var_dump($rows);die();       
            if (!count($rows)) {
                return false;
            }
			$rows->appends(['limit' => $limit])->links();
            return $rows;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
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
            //$query = '%'.$params['query'].'%';
			$array_query = $params['query'];
			//var_dump($array_query);die(); 
			$select = Course::leftJoin('course_categories', 'course_categories.id', '=', 'courses.category')
			/*
			with(
				[
					'account'=> function ($query) {
						$query->select('id','first_name','last_name');
					},
					'courseCategory', 
					'section'
				]
			)
			*/
				->where('courses.delete_status', '=', '0')
				->where('courses.status', '=', "PUBLISHED")
				->where(function ($q) use ($array_query) {
					foreach($array_query as $query){
						//var_dump($query);
						$q->orWhere('courses.name', 'like', '%' . $query . '%')					
						->orWhere('courses.shortname', 'like', '%' . $query . '%')
						->orWhere('courses.shortdescription', 'like',  '%' . $query . '%')
						->orWhere('courses.aboutthecourse', 'like', '%' . $query . '%')
						->orWhere('courses.faq', 'like',  '%' . $query . '%')
						->orWhere('courses.coursesyllabus', 'like',  '%' . $query . '%')
						->orWhere('courses.suggestedreadings', 'like',  '%' . $query . '%')
						->orWhere('courses.recommendedbackground', 'like',  '%' . $query . '%');
						//->orWhere('course_categories.name', 'like',  $query)
						//->orWhere('course_categories.shortname', 'like',  $query)
						//->orWhere('course_categories.description', 'like',  $query);
					}
                });
				//die(); 
			/*
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
            */     
            $rows = $select->select('courses.id','courses.name','courses.shortname','courses.photo')->orderBy('courses.id','DESC')->paginate($limit);
            if (!count($rows)) {
                return [];
            }
			$rows->appends(['limit' => $limit])->links();
            return $rows;            
        }catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage() . " in ". $ex->getFile(). " at line ". $ex->getLine());
        }
    }
}