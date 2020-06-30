<?php


namespace App\Http\Middleware;


use App\Exceptions\PermissionException;
use Hiworks\Auth\Auth;
use Closure;

class CheckIsAdminMiddleware
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
     * @throws PermissionException
     */
    public function handle($request, Closure $next)
    {
        /**
         * composer update 완료 후 필히 refactoring
         */
        if( ( empty($this->auth->getSessionData()) ) ||
            ( empty($this->auth->getSessionData()['n_adminflag']) ) ||
            ( $this->auth->getSessionData()['n_adminflag'] != 'Y')  ){
            throw new PermissionException($this->auth->getOfficeNo(), $this->auth->getOfficeUserNo());
        }
        /**
         *
         */


        return $next($request);
    }

}
