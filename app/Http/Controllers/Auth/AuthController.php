<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function index()
	{
		return view("auth.login");
	}

	public function login(Request $request)
	{
		$request->validate([
			"username" => "required",
			"password" => "required"
		]);

		if (Auth::attempt(["username" => $request->username, "password" => $request->password], $request->remember)) {
			if (!Auth::user()->isOnTerm()) {
				Auth::logout();
				return redirect()->back()->withErrors(["failed" => "Your account is not active, please contact your administrator."]);
			}

			return redirect()->intended(route("dashboard"))->withStatus("welcome");
		}

		return redirect()->back()->withInput()->withErrors(["failed" => "The provided credentials didn't match any of our records."]);
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->route("login")->withStatus("loggedOut");
	}
}
