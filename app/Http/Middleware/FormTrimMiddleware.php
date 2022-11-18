<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FormTrimMiddleware
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
        $input = $request->all();

        $trimmed = [];
        foreach($input as $key => $val)
        {
            // 入力フォームの前後のスペース(全角・半角)を除去する
            $trimmed[$key] = preg_replace('/(^\s+)|(\s+$)/u', '', $val);
        }

        $request->merge($trimmed);

        return $next($request);
    }
}
