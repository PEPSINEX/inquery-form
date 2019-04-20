<?php

namespace App\Http\Middleware;

use Closure;

# 管理者登録機能
# 処理の分離できてないよ
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Auth\RegisterController;

class CheckAdmin
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
       // 管理者は登録スタッフでログインしない
       // 処理の分離ができてないよ
       $staff = \Auth::user();
       if ($staff["is_admin"]) {
           return $RegisterController->authRegister($request);
       }
        return $next($request);
    }
}
