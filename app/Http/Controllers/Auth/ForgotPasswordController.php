<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\StoreForgotPasswordRequest;
use App\Jobs\ForgotPasswordJob;
use App\User;
use Carbon\Carbon;
use App\Traits\HashId;

class ForgotPasswordController extends Controller
{

    use HashId;
    /**
     * ForgotPasswordController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request){
        $data = ['status'=>'error', 'message' => 'Patient email those not exist'];
        $user = User::where('email', $request->email)->first();
        if($user !== null){
            $encoded = $this->encrypt($user->id);
            ForgotPasswordJob::dispatch($user, $encoded['data_token'])->delay(Carbon::now()->addSeconds(5));
            $data = ['status'=>'success', 'message' => 'An email has been sent to you'];
        }
        return response()->json($data);
    }


    public function storeNewPassword(StoreForgotPasswordRequest $request, $id){
        $data = ['status' => 'success', 'message' => 'Password reset successful'];
        $decoded = $this->decrypt($id);
        if(!isset($decoded['data_id'])){
            return response()->json($decoded);
        }
        $user = User::find($decoded['data_id']);
        $user->update(['password' => bcrypt($request->password)]);
        return response()->json($data);
    }
}


