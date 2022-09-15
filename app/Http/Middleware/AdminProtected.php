<?php
/**
 * ClassName: AdminProtected
 * 管理员权限校验中间件
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Staff;

class AdminProtected 
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
        if (Auth::guard('admin')->user()) {
            return $next($request);
        }
        return redirect('/backend/login')->with('error','You have not admin access');
    }
}