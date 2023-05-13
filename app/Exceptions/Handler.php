<?php

namespace App\Exceptions;

use App\Exceptions\Api\AbstractApiException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
    }


    public function render($request, Throwable $exception)
    {
        if ($exception instanceof HttpException) {
            if ($exception->getStatusCode() == 403) {
                return response($exception->getMessage(), 403);
            }
            if ($exception->getStatusCode() == 422) {
                return response($exception->getMessage(), 422);
            }
            if ($exception->getStatusCode() == 400) {
                return response($exception->getMessage(), 400);
            }
        }
        if ($exception instanceof AbstractApiException) {
            return response()->json([
                'status' => 'ashipka, ti loh',
                'reason' => $exception->getMessage(),
                'payload' => $exception->getPayload()
            ], $exception->getCode());
        }
        return parent::render($request, $exception);
    }
}
