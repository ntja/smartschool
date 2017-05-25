<?php

namespace App\Http\Controllers\Views\Courses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LessonController extends Controller {
    
    CONST X_CLIENT_ID = '0000';
    CONST HOST = 'http://127.0.0.1/projects/smartschool/v2/api'; //'http://stagging.smartskul.com/v2/api';
    
    public function get(Request $request, $course_id, $lesson) {
        //$request->header('x-access-token', str_random(50));
        $token = $request->header('x-access-token');
        $result = null;
            $params = array(
            );
           
            $url = sprintf('%s/courses/' . $course_id . '/sections', self::HOST);
            //var_dump($url);die();
            // Get cURL resource
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    sprintf("x-client-id: %s", self::X_CLIENT_ID),
                    "x-access-token: " . $token
                ),
            ));
            //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            //curl_setopt($curl, CURLOPT_USERPWD, 'todd:killersquirrel');
            // Send the request & save response to $resp
            $response = curl_exec($curl);
            // Close request to clear up some resources
            curl_close($curl);
			if(count((array)json_decode($response))>0){
				//var_dump(json_decode($response));die();
				$data = json_decode($response)->data;
				//$data = $data?$data->data:null;
			}else{
				$data = [];
			}			
        return view('courses.lesson')->with(['course_id' => $course_id, 'sections_with_lessons' => $data]);
    }
}