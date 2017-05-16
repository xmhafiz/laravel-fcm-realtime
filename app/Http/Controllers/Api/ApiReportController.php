<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiReportController extends Controller
{
    public function index()
    {
    	return Report::all();
    }
}
