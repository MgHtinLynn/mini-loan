<?php

namespace App\Exceptions;

use App\Helpers\httpStatus;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Mockery\Exception\BadMethodCallException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    use httpStatus;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        ModelNotFoundException::class,
        MethodNotAllowedHttpException::class,
        BadMethodCallException::class,
        InternalErrorException::class,
        QueryException::class,
        NotFoundHttpException::class
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
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->ajax() || $request->wantsJson() || $request->acceptsJson()) {
            if ($exception instanceof MethodNotAllowedHttpException) {
                $data = [
                    'status' => 405,
                    'message' => 'Method Not Allow'
                ];
                return response()->json($data, 405);
            }

            if ($exception instanceof NotFoundHttpException) {
                $data = [
                    'status' => 404,
                    'message' => 'Method Not Found'
                ];
                return response()->json($data, 404);
            }

            if ($exception instanceof BadMethodCallException) {
                $data = [
                    'status' => 400,
                    'message' => 'Bad Request'
                ];
                return response()->json($data, 400);
            }

//            if ($exception instanceof QueryException || $exception instanceof InternalErrorException) {
//                $data = [
//                    'status' => 500,
//                    'message' => 'Internal Server Error'
//                ];
//                return response()->json($data, 500);
//            }

            if ($exception instanceof ModelNotFoundException) {
                $data = [
                    'status' => 400,
                    'message' => 'Model Not Found'
                ];
                return response()->json($data, 400);
            }

            if ($exception instanceof UnauthorizedHttpException || $exception instanceof UnauthorizedException) {
                $data = [
                    'status' => 401,
                    'message' => 'Unauthorized Error'
                ];
                return response()->json($data, 401);
            }

            if ($exception instanceof TokenExpiredException) {
                $data = [
                    'status' => 401,
                    'message' => 'Token Expired Error'
                ];
                return response()->json($data, 401);
            }

            if ($exception instanceof TokenInvalidException) {
                $data = [
                    'status' => 401,
                    'message' => 'Token Invalid Error'
                ];
                return response()->json($data, 401);
            }

            if ($exception instanceof UnauthorizedException) {
                $data = [
                    'status' => 401,
                    'message' => 'User have not permission for this page access.'
                ];
                return response()->json($data, 401);
            }
        }
        return parent::render($request, $exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->ajax() || $request->wantsJson() || $request->acceptsJson()) {
            return $this->unauthenticatedResponse($exception->getMessage());
        }
        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest(route('auth.login'));
    }
}

