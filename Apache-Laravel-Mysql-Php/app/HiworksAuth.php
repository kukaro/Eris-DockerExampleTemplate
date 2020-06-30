<?php

namespace App;

use Hiworks\Auth\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class HiworksAuth implements Authenticatable
{
    use Notifiable;

    /**
     * @var Auth
     */
    private $auth;

    /**
     * HiworksAuth constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {

        $this->auth = $auth;
    }

    public function getHiworksAuth()
    {
        return $this->auth;
    }

    /**
     * @return string|null
     */
    public function getAuthIdentifierName()
    {
        return $this->auth->getIdentifier();
    }

    /**
     * @return mixed|string|null
     */
    public function getAuthIdentifier()
    {
        return $this->auth->getIdentifier();
    }

    public function getAuthPassword()
    {
        // TODO: Implement getAuthPassword() method.
    }

    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }


}
