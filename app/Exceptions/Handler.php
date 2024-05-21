<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    public function render($request, Throwable $exception)
    {
        // return parent::render($request, $exception);
        if ($request->wantsJson()) {   //add Accept: application/json in request
            return $this->handleApiException($request, $exception);
        }else {
            return parent::render($request, $exception);
        }
    }
    private function handleApiException($request, $exception)
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof \Illuminate\Http\Exceptions\HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }
        return $this->customApiResponse($exception);
    }
    private function customApiResponse($exception)
    {
        $response['time'] =  date('Y-m-d H:i:s');
        if(method_exists($exception, 'getMessage'))
        {
            $response['error']['message'] = $exception->getMessage();
        }
        elseif (method_exists($exception, 'getData'))
        {
            $response['error']['message'] = $exception->getData()->message;
        }
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response['resultCode'] = $statusCode;

        switch ($statusCode) {
            case 401:
                $response['error']['title'] = 'UNAUTHORIZED';
                break;
            case 403:
                $response['error']['title'] = 'FORBIDDEN';
                break;
            case 404:
                $response['error']['message'] = ($exception->getMessage() == '') ? 'Page Not Found. If error persists, contact info@solecommerce.com' : $exception->getMessage();
                $response['error']['title'] = 'NOT_FOUND';
                break;
            case 405:
                $response['error']['title'] = 'METHOD_NOT_ALLOW';
                break;
            case 422:
                $response['errors']['title'] = $exception->original['errors'];
                break;
            default:
                $response['error']['message'] =  'Operation Failed!';
                $response['error']['title'] = 'INTERNAL_SERVER_ERROR';
                break;
        }
        return response()->json($response, $statusCode);
    }
}
