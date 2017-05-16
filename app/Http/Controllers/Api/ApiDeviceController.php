<?php

namespace App\Http\Controllers\Api;

use App\Device;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiDeviceController extends Controller
{
	public function register(Request $request) {

		$rules = [
			'firebase_token' => 'required',
			'browser_info' => 'required'
		];

		$this->validate($request, $rules);

		$device = Device::where('firebase_token', $request->firebase_token)->first();
		if (!$device) {
			$device = new Device;
			$device->firebase_token = $request->firebase_token;
		}
		
		$device->browser_info = $request->browser_info;
		$device->save();

		return ['success' => true, 'message' => 'token submitted'];
	}
}
