<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
    * Render an exception into an HTTP response.
    *
    * @param \Illuminate\Http\Request $request
    * @param \Exception               $exception
    * @param Symfony\Component\HttpKernel\Exception\NotFoundHttpException
    * @param Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
    *
    * @return \Illuminate\Http\Response
    */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response([
                'error' => [
                    'error_code'    => 'resource_not_found_error',
                    'error_message' => 'Resource not found errors arise when your request is trying to access the resources not found in datbase.'
                ]
            ], 404);
        }
        if ($exception instanceof AccessDeniedHttpException) {
            return response([ 'error' =>'un-authorized', 'error_message' =>'You are un-authorized for this activity.'], 403);
        }
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'error' => [
                'error_code'    => 'token_error',
                'error_message' => 'Token errors arise when HTTP Authorization request header isn\'t set for request or the token passed in invalid.'
            ]
        ], 401);
    }
}
