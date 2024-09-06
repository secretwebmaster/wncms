<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $filename = storage_path("installed");
        if (file_exists($filename)) {
            if(str(request()->path())->startsWith('install')){
                return redirect()->route('login');
            }
            return $next($request);
        } else {
            //Not installed Yet
            if(!str(request()->path())->startsWith('install')){
                return redirect('/install');
            }
            return $next($request);
        }
    }
}
