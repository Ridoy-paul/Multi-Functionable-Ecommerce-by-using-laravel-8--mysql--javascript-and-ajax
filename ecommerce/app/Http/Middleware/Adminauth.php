<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Adminauth
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
        if($request->session()->has('admin_id')){

        }
        else {
            $request->session()->flash('error', 'Opps! Your\'e Not Logged in, Please Login.');
            return redirect('/cms/login');
        }
        return $next($request);
    }
}
