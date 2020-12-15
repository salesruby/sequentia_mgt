<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($exception instanceof NotFoundHttpException){
            return response()->json([
                'status' => 'error',
                'message'=>'Route not found'
            ], 404);
        }
        elseif($exception instanceof TokenExpiredException){
            $newToken = JWTAuth::parseToken()->refresh();
            return  response()->json([
                'status' => 'error',
                'message'=>'Token expired',
                'data' => [
                    'access_token' => $newToken,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60
                ]
            ]);
        }
        elseif($exception instanceof TokenInvalidException){
            return  response()->json([
                'status' => 'error',
                'message' =>'Token is invalid'
            ], 400);
        }
        elseif($exception instanceof JWTException){
            return  response()->json([
                'status' => 'error',
                'message' =>'Token is required'
            ], 400);
        }
        elseif($exception instanceof AuthorizationException ){
            return  response()->json([
                'status' => 'error',
                'message' =>'You are unauthorized to invite user'
            ], 400);
        }
        elseif ($exception instanceof QueryException){
            return  response()->json([
                'status' => 'error',
                'message' =>'Error occurred while storing your data'
            ], 400);
        }
        return parent::render($request, $exception);
    }
}