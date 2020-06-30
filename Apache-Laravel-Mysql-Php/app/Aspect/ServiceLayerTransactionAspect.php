<?php


namespace App\Aspect;


use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\After;
use Go\Lang\Annotation\AfterThrowing;
use Go\Lang\Annotation\Before;
use Illuminate\Support\Facades\DB;

class ServiceLayerTransactionAspect implements Aspect
{
    /**
     * @param MethodInvocation $invocation
     * @Before("execution(public App\Http\Services\**->*(*))")
     */
    public function beforeMethod(MethodInvocation $invocation)
    {
        DB::beginTransaction();
    }

    /**
     * @param MethodInvocation $invocation
     * @After("execution(public App\Http\Services\**->*(*))")
     */
    public function afterMethod(MethodInvocation $invocation)
    {
        DB::commit();
    }

    /**
     * @param MethodInvocation $invocation
     * @AfterThrowing("execution(public App\Http\Services\**->*(*))")
     */
    public function AfterThrowingMethod(MethodInvocation $invocation)
    {
        DB::rollBack();
    }
}
