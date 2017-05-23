<?php

namespace App\Http\Controllers\Courses;

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

    public function getNonUploadedCourses($storage) {
        //get all courses fro DB
            $courses = DB::table('courses')->select('name')->get()->toArray();
            foreach ($courses as $course) {
                //var_dump($course);die();
                $course_titles[] = $course->name;
            }
            $extract_course_titles = [];
            //var_dump($course_titles);die();
            //return $courses;
            $directories = \File::directories($storage);
            //var_dump($directories);die();
            foreach ($directories as $dir){
                $explode_dir = explode(DIRECTORY_SEPARATOR, $dir);
                $title = end($explode_dir);
                if(in_array($title, $course_titles)){
                    continue;
                }
                $extract_course_titles[] = $title;                
            }
            //var_dump($extract_course_titles);die();
            //end($array);           
            return $extract_course_titles;
    }
    
    public function getLessonsOfCourse() {
        $courses = $this->getNonUploadedCourses('storage/courses');
        $lessons = [];
        foreach ($courses as $course) {
            $directories = \File::directories('storage/courses/'.$course);
            $extract_course_titles = [];
            foreach ($directories as $dir){
                $explode_dir = explode(DIRECTORY_SEPARATOR, $dir);
                $title = end($explode_dir);                
                $extract_course_titles[] = $title;                 
            }
            //var_dump($extract_course_titles);die();
            $lessons[$course] = $extract_course_titles;
        }        
        return $lessons;
    }
    
    public function getVideosOfLessons() {
        try {            
            DB::beginTransaction();
            $lessons = $this->getLessonsOfCourse();
            //var_dump($lessons);die();
            foreach($lessons as $lesson => $values){
                //var_dump($lesson);//die(); $lesson => courses,
                /**/
                $course_id = DB::table('courses')->insertGetId(
                        [
                            'name' => $lesson,
                            'shortname' => Str::slug($lesson),
                            'language' => 'EN',
                            'shortdescription' => ' ',
                            'status' => 'PUBLISHED',
                            'course_type' => 'STANDALONE'
                        ]
                    ); 
                
                foreach($values as $value){
                    //var_dump($value);
                    /**/
                    $section_id = DB::table('course_sections')->insertGetId(
                        [
                            'title' => $value,                            
                            'description' => ' ',                            
                            'course' => $course_id
                        ]
                    );                      
                                         
                    //$directories = \File::directories('storage/courses/'.$lesson.'/'.$value); 
                    //$extract_course_titles = [];
                    $array_files = [];
                    
                    $files = \File::allFiles('storage/courses/'.$lesson.'/'.$value.'/video lectures');
                    foreach ($files as $file){
                        /**/
                        $lesson_id = DB::table('course_lessons')->insertGetId(
                            [
                                'title' =>  explode('.mp4', $file->getFilename())[0],
                                'slug_title' => Str::slug(explode('.mp4', $file->getFilename())[0]),
                                'objective' => ' ',
                                'content' => ' ',
                                'section' => $section_id
                            ]
                        ); 
                        
                        /**/
                        DB::table('lesson_materials')->insert(
                            [
                                'title' => explode('.mp4', $file->getFilename())[0],
                                'type' => 'VIDEO',                                    
                                'link' => $file->getPathname(),
								'extension' => $file->getExtension(),
                                'lesson' => $lesson_id
                            ]
                        ); 
                        
                        $x = [
                            'path' => $file->getPathname(),
                            'file_name' => $file->getFilename(),
                            'extension' => $file->getExtension(),
                            'size' => $file->getSize()
                        ];
                        $array_files[] = $x;
                        //var_dump($array_files);
                    }
                    //return $files;
                    //var_dump($files[0]->getPathname());
                    
                    //$result[$lesson][$value] = $extract_course_titles;
                    $result[$lesson][$value]['video_lectures'] = $array_files;
                }
                //die();
            }
            //die();
            //die();
            DB::commit();
            return isset($result)? $result:'No Course to Upload';
            //var_dump($result);die();            
        } catch (Exception $ex) {
            DB::rollback();
            echo $ex->getessage();
        }        
    }
    
    public function post(Request $request) {        
        try {
            //$file = $request->file()['file'];            
            $lessons = $this->getVideosOfLessons();
            //var_dump($lessons);die();
            return $lessons;
        } catch (Exception $ex) {
            LogRepository::printLog('error', $ex->getMessage());
        }         
    }
}
