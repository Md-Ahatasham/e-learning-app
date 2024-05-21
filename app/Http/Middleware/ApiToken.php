<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ApiToken
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
        $key = $request->header(config('sanctum.api_auth_key'));

        if (empty($key)) {
            throw new UnauthorizedHttpException('Guard', 'The supplied API KEY is missing or an invalid authorization header was sent');
        }

        $secret = config('sanctum.api_auth_secret_key');
        JWT::$leeway = 60;
        $decodedData = JWT::decode($key, new Key($secret, 'HS256'));
        if ($decodedData->url != $request->url()) {
            throw new UnauthorizedHttpException('Guard', 'The supplied API KEY is missing or an invalid authorization header was sent');
        }

        return $next($request);
    }
}
