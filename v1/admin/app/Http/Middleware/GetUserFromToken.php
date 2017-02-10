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
    public function handle($request, \Closure $next)
    {
        $token = $request->header(self::HEADER_TOKEN);
        $request_client_id = $request->header(self::CLIENT_ID);
        
        $client_id = config('app.client-id');

        if($client_id){
            if (strcasecmp($request_client_id, $client_id)) {
                $result = array("code" => 401, "description" => " Invalid application id");
                echo json_encode($result, JSON_UNESCAPED_SLASHES);
                die();
            }
        } else {
            $result = array("code" => 401, "description" => "Application id not found");
            echo json_encode($result, JSON_UNESCAPED_SLASHES);
            die();
        }
        
        
        if (! $token ) {
            return $this->respond('tymon.jwt.absent', 'token_not_provided', 400);
        }
        
        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            return $this->respond('tymon.jwt.expired', 'token_expired', $e->getStatusCode(), [$e]);
        } catch (JWTException $e) {
            return $this->respond('tymon.jwt.invalid', 'token_invalid', $e->getStatusCode(), [$e]);
        }

        if (! $user) {
            return $this->respond('tymon.jwt.user_not_found', 'user_not_found', 404);
        }

        $request->request->add(['user' => $user]);
        
        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}
