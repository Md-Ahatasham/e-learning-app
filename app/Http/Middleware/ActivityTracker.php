<?php

namespace App\Http\Middleware;

use App\Models\UserActivityLog;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ActivityTracker
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
        $response = $next($request);
        if (Auth::check()) {
            $activity = array(
                'user_id' => Auth::user()->id,
                'url' => $request->getUri(),
                'method' => $request->getMethod(),
                'body' => json_encode($request->all()),
                'ip' => $request->getClientIp(),
                'response' => (json_decode($response->getContent()) && isset(json_decode($response->getContent())->resultCode)) ? json_decode($response->getContent())->resultCode : 0,
            );
            try {
                UserActivityLog::insert($activity);
            } catch (Exception $ex) {
                return $response;
            }
        }

        return $response;
    }
}
