<?php

namespace App\Http\Controllers;

use BlueSea\Semaphore\Facades\Semaphore;
use Illuminate\Http\Request;

class SMSController extends Controller
{
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("sms-index"), 403);
		$data["table"] = Semaphore::messages();
		return view("pages.sms", compact("data"));
	}
}
