<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            $bearer =explode(' ', $request->header('Authorization'))[0];
            $token  = explode(' ', $request->header('Authorization'))[1];
            $user   = Admin::where('api_token', $token)->first();
            if ($bearer != 'Bearer' || $user == null) {
                throw new AccessDeniedHttpException;
            }
        } catch (\Exception $e) {
            throw new AuthenticationException;
        }
        return $next($request);
    }
}
