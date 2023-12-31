<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('loggedinUser') && ($request->path() != '/admin_login' && $request->path() !='/RegisterAdmin')){
            return redirect('admin_login');
        }
        if(session()->has('LoggedInUser') && ($request->path() =='/admin_login' || $request->path() == '/RegisterAdmin')){
            return redirect()->back();
        }
        return $next($request);
       
    }
}
