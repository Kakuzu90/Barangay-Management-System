<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\Position;
use App\Models\Purok;
use App\Models\Resident;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("profile-settings"), 403);
		$data["user"] = Auth::user();
		$data["puroks"] = Purok::latest()->get();
		$data["positions"] = Position::exceptAdmin()->latest()->get();
		return view("pages.profile", compact("data"));
	}

	public function general(Request $request)
	{
		abort_if($request->user()->cannot("profile-settings"), 403);
		$request->validate([
			"first_name" => "required",
			"middle_name" => "required",
			"last_name" => "required",
			"phone_number" => ["required", new UniqueEntry("residents", "phone_number", Auth::user()->resident_id)],
			"date_birth" => "required|date|date_format:Y-m-d",
			"place_birth" => "required",
			"gender" => "required",
			"citizenship" => "required",
			"civil_status" => "required",
			"education" => "required",
			"purok" => "required|numeric",
			"address" => "required",
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$array = [
			"first_name" => $request->first_name,
			"middle_name" => $request->middle_name,
			"last_name" => $request->last_name,
			"phone_number" => $request->phone_number,
			"age" => ageCalculator($request->date_birth),
			"date_birth" => $request->date_birth,
			"place_birth" => $request->place_birth,
			"gender" => $request->gender,
			"citizenship" => $request->citizenship,
			"civil_status" => $request->civil_status,
			"education_level" => $request->education,
			"purok_id" => $request->purok,
			"address" => $request->address,
		];

		if ($request->filled("maiden")) {
			$array["maiden_name"] = $request->maiden;
		}
		if ($request->filled("nickname")) {
			$array["nickname"] = $request->nickname;
		}
		if ($request->filled("mother")) {
			$array["mother_name"] = $request->mother;
		}
		if ($request->filled("father")) {
			$array["father_name"] = $request->father;
		}
		if ($request->filled("contact_person")) {
			$array["contact_person"] = $request->contact_person;
		}
		if ($request->filled("contact_address")) {
			$array["contact_address"] = $request->contact_address;
		}

		$user = Resident::where("id", Auth::user()->resident_id)->first();
		$user->update($array);

		if ($user->wasChanged()) {
			$msg = ["General Information Updated", "You have successfully updated your general information's."];
			return goBackWith("success", $msg);
		}

		return goBackWith();
	}

	public function account(Request $request)
	{
		abort_if($request->user()->cannot("profile-settings"), 403);
		$request->validate([
			"username" => ["required", new UniqueEntry("officials", "username", Auth::id())],
			"position" => "nullable|numeric",
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$array = [
			"username" => $request->username
		];

		if ($request->filled("position")) {
			$array["position_id"] = $request->position;
			$array["account_status"] = 1;
		}

		$official = Official::where("id", Auth::id())->first();
		$official->update($array);

		if ($official->wasChanged()) {
			$msg = ["Account Updated", "You have successfully updated your account's credentials."];
			return goBackWith("success", $msg);
		}

		return goBackWith();
	}

	public function password(Request $request)
	{
		abort_if($request->user()->cannot("profile-settings"), 403);
		$request->validate([
			"current" => "required",
			"password" => "required|confirmed"
		]);

		if (!verifyMe($request->current)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		if (verifyMe($request->password)) {
			return goBackWith();
		}

		$official = Official::where("id", Auth::id())->first();
		$official->update([
			"password" => $request->password
		]);

		$msg = ["Password Changed", "You have successfully changed your account's password."];
		return goBackWith("success", $msg);
	}

	public function avatar(Request $request)
	{
		abort_if($request->user()->cannot("profile-settings"), 403);
		$request->validate([
			"profile" => "required"
		]);

		if ($request->filled("profile")) {
			$image = $request->profile;
			list(, $image) = explode(';', $image);
			list(, $image) = explode(',', $image);
			$image = base64_decode($image);

			$filename = Auth::user()->resident->id . ".png";
			$path = storage_path('app/public/profile/' . $filename);
			if (file_exists($path)) {
				unlink($path);
			}
			file_put_contents($path, $image);
		}

		$msg = ["Profile Changed", "You have successfully changed your account's profile."];
		return goBackWith("success", $msg);
	}
}
