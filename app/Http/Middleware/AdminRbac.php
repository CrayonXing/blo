<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Rbac\RbacAuth;

class AdminRbac
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
        $user  = auth('admin')->user();
        if($user->name !=='admin' && !RbacAuth::can($user->id,$request->path())){
            if($request->ajax()){
                return response()->json(['code' => 403,'msg' => '暂无此操作权限!']);
            }else{
                return redirect(route('admin_auth_power'));
            }
        }

        return $next($request);
    }
}
