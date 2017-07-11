<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Admin
{
//    /**
//     * The Guard implementation.
//     *
//     * @var Guard
//     */
//    protected $auth;
//
//    /**
//     * Authenticate constructor.
//     *
//     * @param Guard $auth
//     */
//    public function __construct(Guard $auth) {
//        $this->auth = $auth;
//    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role->role_id !== 1) {
            return response('Forbidden', 403);
        }

        return $next($request);
    }
}
