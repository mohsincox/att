<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */


    // public function render($request, Exception $e)
    // {
    //     return parent::render($request, $e);
    // }

    public function render($request, Exception $e)
    {
        if ($request->wantsJson()) {
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }

        if ($e instanceof AuthorizationException) {

            //return redirect('error');

            //or simply
            //return view('errors.forbidden'); // FatalThrowableError in VerifyCsrfToken.php line 135:      // Call to a member function setCookie() on null

            return response()->view('errors.forbidden');
            //but this will return an OK, 200 response.
        }

        return parent::render($request, $e);
    }
}
