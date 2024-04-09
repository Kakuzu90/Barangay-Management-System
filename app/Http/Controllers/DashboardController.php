<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function index()
	{
		$data["test"] = 0;
		return view("pages.dashboard", compact("data"));
	}
}
