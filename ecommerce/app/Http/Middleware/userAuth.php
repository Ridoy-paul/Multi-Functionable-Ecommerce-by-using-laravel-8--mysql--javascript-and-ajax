<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class userAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userID = Cookie::get('user_id');
        $userName = Cookie::get('user_name');

        if(!empty($userID) && !empty($userName)){

        }
        else {
            return redirect()->back()->with('notAllow', 'You are not logged in!');
        }
        return $next($request);
    }
}
