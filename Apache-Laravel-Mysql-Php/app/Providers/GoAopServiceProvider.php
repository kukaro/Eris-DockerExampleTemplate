<?php


namespace App\Providers;


use App\Aspect\AspectLaravelKernel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Go\Core\AspectContainer;
use Go\Core\AspectKernel;

class GoAopServiceProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     * @return void
     */
    public function boot()
    {
        $this->app->make(AspectContainer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AspectKernel::class, function () {
            $aspectKernel = AspectLaravelKernel::getInstance();
            $aspectKernel->init(config('go_aop'));

            return $aspectKernel;
        });

        $this->app->singleton(AspectContainer::class, function ($app) {
            /** @var AspectKernel $kernel */
            $kernel = $app->make(AspectKernel::class);

            return $kernel->getContainer();
        });
    }
}
