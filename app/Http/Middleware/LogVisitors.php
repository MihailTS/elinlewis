<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Storage;

class logVisitors
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
        if($_SERVER['REMOTE_ADDR']!='46.150.108.117') {
            Storage::append('visitors.txt', print_r($_SERVER, true));
        }
        return $next($request);
    }
}
