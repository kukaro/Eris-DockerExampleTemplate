<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * @var ExceptionHandlerLogic
     */
    private $exceptionHandlerLogic;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];


    /**
     * Report or log an exception.
     *
     * @param Exception $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Exception $exception
     * @return Response
     *
     * @throws Exception
     */
    public function render($request, Exception $exception)
    {
        $app_env = env('APP_ENV', 'production');
        $server_alias = env('SERVER_ALIAS', 'local');

        $this->exceptionHandlerLogic = new ExceptionHandlerLogic(
            $request,
            $request->user()->getHiworksAuth(),
            $server_alias,
            $app_env != 'production'
        );

        if($exception instanceof NotFoundHttpException)
        {
            return $this->exceptionHandlerLogic->notFoundHttpHandler($exception);
        }
        if($exception instanceof AuthenticationException)
        {
            return $this->exceptionHandlerLogic->AuthenticationExceptionHandler($exception);
        }
        if($exception instanceof NotOwnerException)
        {
            return $this->exceptionHandlerLogic->NotOwnerExceptionHandler($exception);
        }
        if($exception instanceof NotOwnerListException)
        {
            return $this->exceptionHandlerLogic->NotOwnerListExceptionHandler($exception);
        }
        return $this->exceptionHandlerLogic->unHandledErrorHandler($exception);
    }
}
