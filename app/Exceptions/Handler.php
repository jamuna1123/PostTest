<?php

// app/Exceptions/Handler.php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    // Other code...

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Handle 404 errors and redirect to the dashboard route
        if ($exception instanceof NotFoundHttpException) {
            return redirect()->route('dashboard');
        }

        // Delegate other exceptions to the parent handler
        return parent::render($request, $exception);
    }
}
