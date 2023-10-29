<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Exception;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->renderable(function (Exception $exception, $request) {
            if ($request->is('api/*')) {
                if ($exception instanceof QueryException) {
                    return response()->json([
                        'message' => 'Record not saved! Please reach out to support.',
                        'error' => $exception->getMessage()
                    ], 500);
                } elseif ($exception instanceof HttpException) {
                    return response()->json([
                        'message' => $exception->getMessage(),
                    ], $exception->getStatusCode());
                }
            }
        });
    }
}
