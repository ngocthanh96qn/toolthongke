<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $users = DB::table('role_users')->where('user_id','=',Auth::user()->id)->get();
        $role = $users->toArray()[0]->role_id;
        if ($role==1) {
           return $next($request);
        }
        if ($role==2) {
            return redirect()->route('menu.analytic_nv');
        }
        
    }
}
