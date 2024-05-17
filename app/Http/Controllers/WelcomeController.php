<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WelcomeController extends Controller
{
	public function __invoke(Request $request)
	{
		$year = $request->input('year', Carbon::now()->year);
		$query = Official::exceptAdmin()->whereYear("term_to", $year);
		$data["officials"] = $query->with("position")
			->get()->sortBy(function ($official) {
				return $official->position->priority;
			});
		$data["mission"] = Setting::mission()->first()->content;
		$data["vision"] = Setting::vision()->first()->content;
		return view("pages.welcome", compact("data"));
	}
}
