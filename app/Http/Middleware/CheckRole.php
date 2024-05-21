<?php

namespace App\Http\Middleware;
use App\Http\Traits\V1\ResponseTrait;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(empty($request->header('current_role'))){
            return $this->sendError('Role Not Found', 'Role is missing in the request header', 422);
         }
         if(Auth::user()->current_role != $request->header('current_role')){
            return $this->sendError('Role Mismatch', 'Provided role is not allowed to access this url', 422);
         }
         return $next($request);
         
    }
}
