<?php


namespace App\Exceptions;


use Hiworks\Auth\Auth;

class AuthException extends \Exception
{
    /**
     * @var Auth
     */
    private $auth;

    /**
     * AuthException constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @return Auth
     */
    public function getAuth(): Auth
    {
        return $this->auth;
    }

}
