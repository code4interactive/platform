<?php

namespace Code4\Platform\Middleware;

use Closure;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Sentinel::guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/login');
            }
        }

        /*$credentials = [
            'email'    => 'artur.bartczak@code4.pl',
            'password' => 'c4chronchol',
        ];

        $user = \Sentinel::forceAuthenticate($credentials);*/

        return $next($request);
    }
}
