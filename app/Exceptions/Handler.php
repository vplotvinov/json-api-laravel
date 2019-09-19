<?php

namespace App\Exceptions;

use CloudCreativity\LaravelJsonApi\Exceptions\HandlesErrors;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Neomerx\JsonApi\Exceptions\JsonApiException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class Handler extends ExceptionHandler
{
    use HandlesErrors;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,
        JsonApiException::class,
    ];

    /**
     * @param Exception $e
     *
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $e)
    {
        $request = new Request(); // TODO: Need clarify for request, because it is strange
        if ($this->isJsonApi($request, $e)) {
            return $this->renderJsonApi($request, $e);
        }

//        if (app()->bound('sentry') && $this->shouldReport($e) && app()->environment() === 'prod') {
//            app('sentry')->captureException($e);
//        }

        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request   $request
     * @param Exception $exception
     *
     * @return Response
     */
    public function render($request, Exception $exception)
    {
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'method not allowed',
//                    'test' => $exception->getPrevious(),
                ], 404);
            }
        }

        if ($exception instanceof UnauthorizedHttpException) {
            // detect previous instance
            if ($exception->getPrevious() instanceof TokenExpiredException) {
                return response()->json(['error' => 'TOKEN_EXPIRED'], $exception->getStatusCode());
            } elseif ($exception->getPrevious() instanceof TokenInvalidException) {
                return response()->json(['error' => 'TOKEN_INVALID'], $exception->getStatusCode());
            } elseif ($exception->getPrevious() instanceof TokenBlacklistedException) {
                return response()->json(['error' => 'TOKEN_BLACKLISTED'], $exception->getStatusCode());
            } else {
                return response()->json(['error' => "UNAUTHORIZED_REQUEST"], 401);
            }
        }

        return parent::render($request, $exception);
    }

    protected function prepareException(Exception $e)
    {
        if ($e instanceof JsonApiException) {
            return $this->prepareJsonApiException($e);
        }

        return parent::prepareException($e);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param Request                 $request
     * @param AuthenticationException $exception
     *
     * @return Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Unauthenticated.'
            ], 401);
        }

        return redirect()->guest('login');
    }
}
