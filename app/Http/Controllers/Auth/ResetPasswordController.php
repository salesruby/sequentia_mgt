<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('patient');
    }

    public function reset(ResetPasswordRequest $request){
        $data =['status' => 'error', 'message'=> 'Your password is incorrect'];
        if(Hash::check($request->old_password, auth()->user()->password)){
            auth()->user()->update(['password' => bcrypt($request->new_password)]);
            $data =['status' => 'success', 'message'=> 'Password reset was successful'];
        }
        return response()->json($data);
    }

}
