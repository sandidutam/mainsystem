<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NoCacheHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $response = $next($request);

        // $response->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        // $response->header('Cache-Control', 'no-cache, must-revalidate, no-store, max-age=0, private');

        // return $response;
        $response = $next($request);
        $headers = [
            'Cache-Control' => 'nocache, no-store, max-age=0, must-revalidate',
            'Pragma','no-cache',
            'Expires','Fri, 01 Jan 1990 00:00:00 GMT',
        ];

        foreach($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}
