<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("sms-index"), 403);
		return view("pages.sms");
	}
}
