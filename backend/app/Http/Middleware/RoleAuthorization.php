<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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
            try {
                //Access token from the request
                $token = JWTAuth::parseToken();
                //Try authenticating user
                $user = $token->authenticate();
            } catch (TokenExpiredException $e) {
                 // If the token is expired, then it will be refreshed and added to the headers
                try
                {
                    $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                    $user = JWTAuth::setToken($refreshed)->toUser();
                    header('Authorization: Bearer ' . $refreshed);
                }
                catch (JWTException $e)
                {
                //Thrown if token has expired
                return $this->unauthorized('Your token has expired. Please, login again.');
                }
                $user = JWTAuth::setToken($refreshed)->toUser();
                
            } catch (TokenInvalidException $e) {
                //Thrown if token invalid
                return $this->unauthorized('Your token is invalid. Please, login again.');
            }catch (JWTException $e) {
                //Thrown if token was not found in the request.
                return $this->unauthorized('Please, attach a Bearer Token to your request');
            }
            //If user was authenticated successfully and user is in one of the acceptable roles, send to next request.
            //The variable argument $roles gives you the ability to give more than one role access to a particular route and can is used as an array inside the function.
            if ($user && $user->role) {
                return $next($request);
            }
            return $this->unauthorized();
     }
    private function unauthorized($message = null){
            return response()->json([
                'message' => $message ? $message : 'You are unauthorized to access this resource',
                'success' => false
            ], 401);
    }
}
