<?php

namespace App\Http\Middleware;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class GetUserFromToken extends BaseMiddleware
{
    
    const HEADER_TOKEN = 'x-access-token';
    const CLIENT_ID = 'x-client-id';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next, $force_success = 0)
    {        
        $token = $request->header(self::HEADER_TOKEN);
        $request_client_id = $request->header(self::CLIENT_ID);
        
        $client_id = config('app.client-id');

        if($client_id){
            if (strcasecmp($request_client_id, $client_id)) {
                $result = array("code" => 401, "description" => " Invalid application ID");
                echo json_encode($result, JSON_UNESCAPED_SLASHES);
				http_response_code(400);
                die();
            }
        } else {
            $result = array("code" => 401, "description" => "Application ID not found");
            echo json_encode($result, JSON_UNESCAPED_SLASHES);
			http_response_code(400);
            die();
        }
        
        
        if (! $token ) {
            if(!$force_success){
                $result = array("code" => 4000, "description" => "token not provided");
				http_response_code(400);
               echo json_encode($result, JSON_UNESCAPED_SLASHES);
               die();   
            }
            $request->request->add(['account_id' => null]);
            $request->request->add(['token' => null]);        
            return $next($request);
        }
        
        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
			$result = array("code" => 4003 , "description" => "token expired");
            echo json_encode($result, JSON_UNESCAPED_SLASHES);
			http_response_code(400);
            die();
        } catch (JWTException $e) {
           $result = array("code" => 4000, "description" => "Invalid Token");
            echo json_encode($result, JSON_UNESCAPED_SLASHES);
			http_response_code(400);
            die();
        }

        if (! $user) {
            return $this->respond('tymon.jwt.user_not_found', 'user not found', 404);
        }
        $request->request->add(['account_id' => $user->id]);
        $request->request->add(['token' => $token]);
        
        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}
