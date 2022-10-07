<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Auth\AuthenticationException;

class ApiKeyAuth
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

        if(!$request->get('apikey') || $request->get('apikey') != config('app.api_key')){
            ApiLog::create(
                [
                    'request_ip'=>\Illuminate\Support\Facades\Request::ip(),
                    'created_at'=>Carbon::now(),
                    'status'=>'error'
                ]
            );
            return response([
                'status' => 'error',
                'description' => "Wrong api key"
           ], 422);

          }
          ApiLog::create(
            [
                'request_ip'=>\Illuminate\Support\Facades\Request::ip(),
                'created_at'=>Carbon::now(),
                'status'=>'success'
            ]
        );
        return $next($request);
    }
}
