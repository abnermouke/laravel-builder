<?php


namespace Abnermouke\LaravelBuilder\Middlewares;

use Closure;
use Illuminate\Http\Request;

/**
 * Laravel Builder Base Middleware Power By Abnermouke
 * Class LaravelBuilderBaseMiddleware
 * @package Abnermouke\LaravelBuilder\Middlewares
 */
class LaravelBuilderBaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //记录请求时间
        $request->offsetSet('logic_request_log_time', time());

        //TODO ：其他中间件操作


        return $next($request);
    }
}
