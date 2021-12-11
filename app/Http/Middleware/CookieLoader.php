<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class CookieLoader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // // dd('ok');
        // // function check_user(Response $response, $request)
        // // {
        // // $response->withCookie(cookie('todo_id', '333', 60));
        // Cookie::queue('todo_id', "7", 20);

        // $todo_id = $request->cookie('todo_id');
        // $request->session()->put('todo_id', $todo_id);
        // // }

        return $next($request);
    }
}