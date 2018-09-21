<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
//Be sure to include the exception you want at the top of the file
use PayPal\Exception\PayPalConnectionException;//pull in paypal error exception to work with
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Session\TokenMismatchException;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if($exception instanceof NotFoundHttpException)
        {
                return response()->view('layouts.404', [], 404);
        }
        if ($exception instanceof TokenMismatchException)
        {
            // Redirect to a form. Here is an example of how I handle mine
            return redirect('/')->with('csrf_error',"Oops! Seems you couldn't submit form for a long time. Please try again.");
            
        }
         if ($exception instanceof PayPalConnectionException)
        {
            // Redirect to a dashboard. Here is an example of how I handle mine
            return redirect('/dashboard')->with('error',"Oops! Something Went Wrong. Please Try Again.");
            
        }
        return parent::render($request, $exception);
    }
    /*public function render($request, Exception $e)
    {
        //check the specific exception
        if ($e instanceof PayPalConnectionException) {
            //return with errors and with at the form data
            $err_data = json_decode($e->getData(), true);
            return $err_data;
            //return Redirect::back()->withErrors($e->getData())->withInput(Input::all());
        }

        return parent::render($request, $e);
    }*/ 

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
