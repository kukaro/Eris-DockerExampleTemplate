<?php

namespace App\Providers;

use App\HiworksAuth;
use App\Models\Hiworks\Office;
use Hiworks\Auth\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var Auth
     */
    private $auth;

    /**
     * AuthServiceProvider constructor.
     * @throws AuthenticationException
     */
    public function __construct($app)
    {
        parent::__construct($app);
        $memcached = new \Memcached();

        $hiworks_session_host = explode(',', env('HIWORKS_MEMCACHED_HOST', '127.0.0.1'));
        $hiworks_session_port = env('HIWORKS_MEMCACHED_PORT', 11211);

        foreach ($hiworks_session_host as $session_host) {
            $memcached->addServer($session_host, $hiworks_session_port);
        }

        $this->auth = new Auth($memcached);
    }

    /**
     *
     */
    public function register()
    {

        $this->registerPolicies();

        $this->app->singleton(Auth::class, function ($app) {
            return $this->auth;
        });

        \Illuminate\Support\Facades\Auth::viaRequest('hiworks-auth', function ($request) {
            return new HiworksAuth($this->auth);
        });
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
