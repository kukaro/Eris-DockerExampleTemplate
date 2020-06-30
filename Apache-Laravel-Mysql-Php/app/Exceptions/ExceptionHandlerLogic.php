<?php


namespace App\Exceptions;


use Exception;
use Hiworks\Auth\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use JsonApiHelper\JsonApiHelper;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionHandlerLogic
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Auth
     */
    private $auth;

    /**
     * @var string
     */
    private $server;

    /**
     * @var bool
     */
    private $is_production;

    /**
     * ExceptionHandlerLogic constructor.
     * @param Request $request
     * @param Auth $auth
     * @param string $server
     * @param bool $is_debug
     */
    public function __construct(Request $request, Auth $auth, string $server, bool $is_debug)
    {
        $this->request = $request;
        $this->auth = $auth;
        $this->server = $server;
        $this->is_production = $is_debug;
    }

    /**
     * @param Exception $exception
     * @return string
     */
    public function commonMessage(Exception $exception)
    {
        $log =
            "\n- Server : ".$this->server.
            "\n- url : \n" . json_encode($this->request->url(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES).
            "\n- method : \n" . $this->request->getMethod().
            "\n- exception name : \n" .get_class($exception).
            "\n- exception code : \n" .$exception->getCode().
            "\n- exception msg  : \n" .$exception->getMessage().
            "\n- Hiworks Identifier  : \n" .$this->auth->getIdentifier().
            "\n- referrer : \n" . json_encode($this->request->headers->get('referer'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES).
            "\n- agent : ".$this->request->headers->get('User-Agent').
            "\n- Request All Param : \n" . json_encode($this->request->all(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES).
            "\n- trace : \n" .$exception->getTraceAsString();

        return $log;
    }

    /**
     * @param string $channelName
     * @param string $logType
     * @param string $log
     */
    private function writeLog(string $channelName, string $logType, string $log)
    {
        $log = "\n[[[ bookmark-api {$channelName} error ]]]" .$log;

        $this->sendMail($channelName, $log);
        $this->writeSysLog($channelName, $logType, $log);
    }

    /**
     * @param string $channelName
     * @param string $logType
     * @param string $log
     */
    private function writeSysLog(string $channelName, string $logType, string $log)
    {
        Log::channel($channelName.'-syslog')->{$logType}($log);
    }

    /**
     * @param string $subject
     * @param string $log
     */
    private function sendMail(string $subject, string $log)
    {
        /////////////
    }

    /**
     * @param AuthenticationException $exception
     * @return JsonResponse
     */
    public function AuthenticationExceptionHandler(AuthenticationException $exception)
    {
        return $this->response(401, 'Auth Exception.');
    }

    /**
     * @param NotFoundHttpException $exception
     * @return JsonResponse
     */
    public function notFoundHttpHandler(NotFoundHttpException $exception)
    {
        return $this->response(404, 'notFoundHttpHandler Exception.');
    }

    public function NotOwnerExceptionHandler(NotOwnerException $exception)
    {
        return $this->response(401,
            "User don't have category no".$exception->getRequestBookmarkCategory()->getNo()
        );
    }

    public function NotOwnerListExceptionHandler(NotOwnerListException $exception)
    {
        return $this->response(401,
            "User don't have category no list : ".json_encode($exception->getRequestBookmarkCategoryNoList())
        );
    }

    /**
     * @param Exception $exception
     * @return JsonResponse
     */
    public function unHandledErrorHandler(Exception $exception)
    {
        $log = $this->commonMessage($exception);

        $this->writeLog('unhandled-error','error', $log);

        return $this->response($exception->getCode(), $exception->getMessage());
    }

    /**
     * @param $status
     * @param $title
     * @param null $source
     * @param null $detail
     * @return JsonResponse
     */
    private function response($status, $title, $source=null, $detail=null)
    {
        if(empty($status))
        {
            $status = 500;
        }
        return response()->json(JsonApiHelper::getErrorObject($status, $title, $source, $detail), $status);
    }
}
