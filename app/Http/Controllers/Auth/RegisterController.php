<?php

namespace App\Http\Controllers\Auth;

use App\Models\Official;
use App\Models\Position;
use App\Models\Resident;
use App\Models\Permission;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
	public function index()
	{
		$data["positions"] = Position::exceptImportant()->latest()->get();
		return view("auth.register", compact("data"));
	}

	public function store(Request $request)
	{
		$request->validate([
			"first_name" => "required",
			"middle_name" => "required",
			"last_name" => "required",
			"username" => ["required", new UniqueEntry("officials", "username")],
			"password" => "required|confirmed",
			"position" => "required|numeric",
		]);

		$resident = Resident::create([
			"first_name" => $request->first_name,
			"middle_name" => $request->middle_name,
			"last_name" => $request->last_name,
		]);

		$official = Official::create([
			"resident_id" => $resident->id,
			"username" => $request->username,
			"password" => $request->password,
			"position_id" => $request->position,
		]);

		$position_permission = Position::where("id", $official->position_id)->first()->permissions()->get(["permission_id"])->pluck("permission_id");
		$permissions = Permission::whereIn("id", $position_permission)->get();
		$official->permissions()->saveMany($permissions);

		return redirect()->back()->withStatus("registered");
	}
}
