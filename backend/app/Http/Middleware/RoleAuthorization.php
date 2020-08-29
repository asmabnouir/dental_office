<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Cookie;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     //The handle function tries to access the token from the request and 
     //then authenticate the user and if it fails at any point, the proper catch block will take
     // care of it and return a json error object to the user, else the user would be sent to the request would continue to the next phrase.
    public function handle($request, Closure $next)
    {
           try{
                //Access token from the request
                $token = JWTAuth::parseToken();
                //Try authenticating user
                $user = $token->authenticate();
            }catch (JWTException $e)
                {
                //Thrown if token has expired
                return $this->unauthorized('Your token has expired. Please, login again.');
                //$user = JWTAuth::setToken($refreshed)->toUser();

            }catch (TokenInvalidException $e) {
                //Thrown if token invalid
                return $this->unauthorized('Your token is invalid. Please, login again.');
         }
}
}