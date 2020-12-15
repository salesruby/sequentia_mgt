<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(RegistrationRequest $request)
    {
        $password = ['password' => bcrypt($request->password),];
        $user = User::create($request->except('password')  + $password);
        $token = $this->guard()->login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful',
            'data' => (object)[
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => $user
            ]
        ]);
    }


    /**
     * @return mixed
     */
    public function guard()
    {
        return Auth::guard();
    }

}
