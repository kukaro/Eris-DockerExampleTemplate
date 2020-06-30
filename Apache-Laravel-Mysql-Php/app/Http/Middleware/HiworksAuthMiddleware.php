<?php


namespace App\Http\Middleware;


use Hiworks\Auth\Auth;
use Closure;
use Illuminate\Auth\AuthenticationException;

class HiworksAuthMiddleware
{
    /**
     * @var Auth
     */
    private $auth;

    /**
     * HiworksAuthMiddleware constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        if(empty($this->auth->isLogin()))
        {
            throw new AuthenticationException();
        }

        return $next($request);
    }

}
