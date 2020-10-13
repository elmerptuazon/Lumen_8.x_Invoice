<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use App\Models\User;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if ($this->auth->guard($guard)->guest()) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // return $next($request);
        if ($request->header('Authorization')) {
                $key = explode(' ',$request->header('Authorization'));
                
                $user = User::where('api_key', $key[1])->first();
                    if(!empty($user)){
                        // dd(!empty($user));
                        return $next($request);
                    }else {
                        return response()->json(['error' => 'Unauthorized'], 401);
                    }
                
            }
            
            return response()->json(['error' => 'Unauthorized'], 401);
    }
}
