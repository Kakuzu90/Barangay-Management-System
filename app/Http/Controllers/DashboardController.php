<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("dashboard-index"), 403);
		$data["mission"] = Setting::mission()->first()->content;
		$data["vision"] = Setting::vision()->first()->content;
		return view("pages.dashboard", compact("data"));
	}
}
