<?php

namespace App\Http\Controllers;

use App\Demo;
use App\Http\Requests\DemoRequest;
use App\Mail\DemoResponse;
use App\Mail\DemoResponseMail;
use App\Mail\DemoResquestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demoRequest = Demo::all();
        return response()->json([
            'status' => 'success',
            'message' => 'request successful',
            'data' => (object)['demo_request' => $demoRequest]
        ]);

    }

    public function create()
    {
//        return view('demo.create');
    }


    /**
     * @param DemoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DemoRequest $request)
    {
        $data = ['status' => 'success', 'message' => 'Your request for a demo was successfully'];

        try {
            Mail::to($request->email)->send(new DemoResponseMail($request->all()));
            Mail::to('sales@salesruby.com')->send(new DemoResquestMail($request->all()));
        } catch (\Exception $exception) {
            $data = ['status' => 'error', 'message' => $exception->getMessage()];
        }
        $demoRequest = Demo::create($request->all());
        if (!$demoRequest) {
            $data = [
                'status' => 'error',
                'message' => 'Unable to place a request',
                'data' => ['demo_request' => $demoRequest]
            ];
        }
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Demo $demo
     * @return \Illuminate\Http\Response
     */
    public function show(Demo $demo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Demo $demo
     * @return \Illuminate\Http\Response
     */
    public function edit(Demo $demo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Demo $demo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demo $demo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Demo $demo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demo $demo)
    {
        //
    }
}
