<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class SetupController extends Controller
{
    public function index(){
        Artisan::call('migrate');
        Artisan::call('db:seed');
        Artisan::call('route:clear');
        Artisan::call('config:cache');

        return response()->json(['status'=>'success', 'message' => 'Setup Successful']);
    }
}
