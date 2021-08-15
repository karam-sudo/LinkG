<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;

class ApiAuth
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
        // $tokenValid = ApiKey::where('api_key', $request->header('Authorization'))->exists();

        // if (!$tokenValid) {
        //     return response()->json('Unauthorized', 401);
        // } 
        // return $next($request);
    }
}
