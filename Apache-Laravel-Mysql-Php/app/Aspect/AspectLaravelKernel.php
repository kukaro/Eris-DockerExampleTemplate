<?php


namespace App\Aspect;

use App\Aspect\ServiceLayerTransactionAspect;
use Go\Core\AspectContainer;
use Go\Core\AspectKernel;

class AspectLaravelKernel extends AspectKernel
{

    /**
     * @inheritDoc
     */
    protected function configureAop(AspectContainer $container)
    {
        $container->registerAspect(new ServiceLayerTransactionAspect());
    }
}
