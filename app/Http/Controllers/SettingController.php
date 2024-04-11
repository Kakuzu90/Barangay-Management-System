<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("system-settings"), 403);
		$settings["mission"] = Setting::mission()->first();
		$settings["vision"] = Setting::vision()->first();
		return view("pages.setting", compact("settings"));
	}

	public function update(Request $request, Setting $setting)
	{
		abort_if($request->user()->cannot("system-settings"), 403);
		$request->validate([
			"content" => "required"
		]);

		$setting->update([
			"content" => $request->content
		]);

		if ($setting->wasChanged()) {
			$msg = [$setting->title . "Changed", $setting->title . " has been successfully updated."];
			return goBackWith("success", $msg);
		}

		return goBackWith();
	}
}
