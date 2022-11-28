<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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


        //Response for AccessDeniedHttpException to API
        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return HandlerResponse::respondWithError($e->getMessage(), $e->getStatusCode());
            }
        });


        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {

                if($e->getMessage() == ''){
                    $message = 'Not Found';
                }else{
                    $message = $e->getMessage();
                }

                $errors = [
                    'e' => $message
                ];

                return HandlerResponse::respondWithError($message, $e->getStatusCode(), $errors);

            }
        });


        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                if($e->getMessage() == ''){
                    $message = 'Not Found';
                }else{
                    $message = $e->getMessage();
                }

                $errors = [
                    'e' => trans('no query result')
                ];

                return HandlerResponse::respondWithError($message, $e->getStatusCode(), $errors);
            }
        });


        //Descomentar esto luego:
//        $this->renderable(function (QueryException $e, $request) {
//            if ($request->is('api/*')) {
//
//                $message = 'QueryException';
//
//                $errors = [
//                    'e' => $message
//                ];
//
//                return HandlerResponse::respondWithError($message, 201, $errors);
//            }
//        });


    }
}
