<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
	public function __invoke()
	{
		$data["mission"] = Setting::mission()->first()->content;
		$data["vision"] = Setting::vision()->first()->content;
		return view("pages.welcome", compact("data"));
	}
}
