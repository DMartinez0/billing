<?php

namespace App\Http\Middleware;

use App\System\Config\Validate;
use Closure;
use Illuminate\Http\Request;



class SystemValidate
{

    use Validate;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->systemValidate()) {
            return $next($request);
        } 
        abort(401, 'NO ACTIVATED');
    }
}
