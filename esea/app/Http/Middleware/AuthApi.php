<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AuthApi
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
        if(empty(Auth::user())) {
            return self::JsonExport(401, 'Vui lòng đăng nhập');
        }
        if (!$request->expectsJson()) {
            return self::JsonExport(401, 'Vui lòng đăng nhập');
        }
        return $next($request);
    }

    static public function JsonExport($code, $msg)
    {
        $callback = [
            'code' => $code,
            'msg' => $msg
        ];
        return response()->json($callback, 200, [], JSON_NUMERIC_CHECK);
    }

}
