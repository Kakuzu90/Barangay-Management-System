<?php

namespace App\Http\Controllers;

use App\Models\Purok;
use App\Models\Resident;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("resident-index"), 403);
		$data["residents"] = Resident::exceptAdmin()->where("id", "!=", Auth::user()->resident_id)->latest()->get();
		return view("pages.resident.index", compact("data"));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request)
	{
		abort_if($request->user()->cannot("resident-store"), 403);
		$puroks = Purok::latest()->get();
		return view("pages.resident.create", compact("puroks"));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort_if($request->user()->cannot("resident-store"), 403);
		$request->validate([
			"first_name" => "required",
			"middle_name" => "required",
			"last_name" => "required",
			"phone_number" => ["required", new UniqueEntry("residents", "phone_number")],
			"date_birth" => "required|date|date_format:Y-m-d",
			"place_birth" => "required",
			"gender" => "required",
			"citizenship" => "required",
			"civil_status" => "required",
			"education" => "required",
			"purok" => "required|numeric",
			"address" => "required"
		]);

		$resident = Resident::create([
			"first_name" => $request->first_name,
			"middle_name" => $request->middle_name,
			"last_name" => $request->last_name,
			"maiden_name" => $request->maiden,
			"nickname" => $request->nickname,
			"phone_number" => $request->phone_number,
			"age" => ageCalculator($request->date_birth),
			"date_birth" => $request->date_birth,
			"place_birth" => $request->place_birth,
			"gender" => $request->gender,
			"citizenship" => $request->citizenship,
			"civil_status" => $request->civil_status,
			"mother_name" => $request->mother,
			"father_name" => $request->father,
			"education_level" => $request->education,
			"purok_id" => $request->purok,
			"contact_person" => $request->contact_person,
			"contact_address" => $request->contact_address,
			"address" => $request->address,
		]);

		if ($request->filled("profile")) {
			$image = $request->profile;
			list(, $image) = explode(';', $image);
			list(, $image) = explode(',', $image);
			$image = base64_decode($image);

			$filename = $resident->id . ".png";
			$path = storage_path('app/public/profile/' . $filename);
			if (file_exists($path)) {
				unlink($path);
			}
			file_put_contents($path, $image);
		}

		$msg = ["Resident Added", "New resident has been successfully added."];

		return goBackWith("success", $msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Resident  $resident
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, Resident $resident)
	{
		abort_if($request->user()->cannot("resident-show"), 403);
		return view("pages.resident.show", compact("resident"));
	}

	public function ajax(Request $request, Resident $resident)
	{
		abort_if($request->user()->cannot("resident-show"), 403);
		return $resident;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Resident  $resident
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, Resident $resident)
	{
		abort_if($request->user()->cannot("resident-update"), 403);
		$puroks = Purok::latest()->get();
		return view("pages.resident.edit", compact("puroks", "resident"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Resident  $resident
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Resident $resident)
	{
		abort_if($request->user()->cannot("resident-update"), 403);
		$request->validate([
			"first_name" => "required",
			"middle_name" => "required",
			"last_name" => "required",
			"phone_number" => ["required", new UniqueEntry("residents", "phone_number", $resident->id)],
			"date_birth" => "required|date|date_format:Y-m-d",
			"place_birth" => "required",
			"gender" => "required",
			"citizenship" => "required",
			"civil_status" => "required",
			"education" => "required",
			"purok" => "required|numeric",
			"address" => "required"
		]);
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

		$resident->update($array);

		if ($request->filled("profile")) {
			$image = $request->profile;
			list(, $image) = explode(';', $image);
			list(, $image) = explode(',', $image);
			$image = base64_decode($image);

			$filename = $resident->id . ".png";
			$path = storage_path('app/public/profile/' . $filename);
			if (file_exists($path)) {
				unlink($path);
			}
			file_put_contents($path, $image);
		}

		if ($resident->wasChanged()) {
			$msg = ["Resident Updated", "The resident has been successfully updated."];
			return goBackWith("update", $msg);
		}

		return goBackWith();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Resident  $resident
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Resident $resident)
	{
		abort_if($request->user()->cannot("resident-delete"), 403);
		$request->validate([
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$resident->update(["deleted_at" => Carbon::now()]);

		$msg = ["Resident Deleted", "The resident with the name of " . $resident->fullname . " has been deleted."];

		return goBackWith("delete", $msg);
	}
}
