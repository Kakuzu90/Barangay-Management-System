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
	}

	public function logout()
	{
		Auth::logout();

		return redirect()->route("login")->withStatus("loggedOut");
	}
}
