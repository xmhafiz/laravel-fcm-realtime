<?php

namespace App\Http\Controllers;

use App\Device;
use App\Jobs\SendNotification;
use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('report.user_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'report_title' => 'required',
            'report_description' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ];

        $this->validate($request, $rules);

        // create report
        $report = Report::create($request->all());

        // get total count
        

        // send firebase notification
        $payload = [
            'message_type' => 'new_data',
            'item' => $report,
        ];

        $devices = Device::all();

        $devices->each(function( $device) use ($payload) {
            dispatch(new SendNotification($device->firebase_token, $payload));
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
