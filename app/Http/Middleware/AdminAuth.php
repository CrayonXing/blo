<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        if(!auth('admin')->check()){
            if($request->ajax()){
                return response()->json(['code' => 401,'msg' => '请登录后再进行操作!']);
            }else{
                return redirect('/admin/login');
            }
        }

        return $next($request);
    }
}
