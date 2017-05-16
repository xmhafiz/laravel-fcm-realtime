<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Report;
use Illuminate\Http\Request;

class ApiReportController extends Controller
{
    public function index()
    {
    	return Report::orderBy('id', 'desc')->get();
    }
}
