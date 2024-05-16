<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\Permission;
use App\Models\Position;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OfficialController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("barangay-official-index"), 403);
		$data["officials"] = Official::exceptAdmin()->latest()->get();
		$data["positions"] = Position::exceptAdmin()->latest()->get();
		return view("pages.official.index", compact("data"));
	}

	public function active(Request $request)
	{
		abort_if($request->user()->cannot("barangay-official-index"), 403);
		$year = $request->input("year");
		$query = Official::exceptAdmin();
		if ($year) {
			$query->whereYear("term_to", $year);
		} else {
			$query->active();
		}
		$officials = $query->with("position")
			->get()->sortBy(function ($official) {
				return $official->position->priority;
			});

		$officials = $officials->values()->all();
		return view("pages.official.active", compact("officials"));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort_if($request->user()->cannot("barangay-official-store"), 403);
		$request->validate([
			"resident" => "required|numeric",
			"username" => ["required", new UniqueEntry("officials", "username")],
			"password" => "required|confirmed",
			"position" => "required|numeric",
			"date_from" => "required|date|date_format:Y-m-d",
			"date_to" => "required|date|date_format:Y-m-d",
		]);

		$official = Official::create([
			"resident_id" => $request->resident,
			"username" => $request->username,
			"password" => $request->password,
			"position_id" => $request->position,
			"term_from" => $request->date_from,
			"term_to" => $request->date_to,
			"account_status" => 2 // active
		]);

		$position_permission = Position::where("id", $official->position_id)->first()->permissions()->get(["permission_id"])->pluck("permission_id");
		$permissions = Permission::whereIn("id", $position_permission)->get();
		$official->permissions()->saveMany($permissions);

		$msg = ["Official Added", "New official has been successfully added."];

		return goBackWith("success", $msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Official  $official
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, Official $official)
	{
		abort_if($request->user()->cannot("barangay-official-index"), 403);
		return [
			"id" => $official->id,
			"resident" => $official->resident_id,
			"fullname" => $official->resident->fullname,
			"avatar" => $official->resident->avatar(),
			"position" => $official->position_id,
			"username" => $official->username,
			"date_from" => $official->term_from,
			"date_to" => $official->term_to,
			"account" => $official->account_status,
		];
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Official  $official
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Official $official)
	{
		abort_if($request->user()->cannot("barangay-official-update"), 403);
		$request->validate([
			"resident" => "required|numeric",
			"username" => ["required", new UniqueEntry("officials", "username", $official->id)],
			"password" => "nullable|confirmed",
			"position" => "required|numeric",
			"date_from" => "required|date|date_format:Y-m-d",
			"date_to" => "required|date|date_format:Y-m-d",
			"status" => "numeric"
		]);

		$array = [
			"resident_id" => $request->resident,
			"username" => $request->username,
			"position_id" => $request->position,
			"term_from" => $request->date_from,
			"term_to" => $request->date_to,
			"account_status" => $request->filled("status") ? $request->status : 1,
		];

		if ($request->filled("password")) {
			$array["password"] = $request->password;
		}

		$official->update($array);

		$position_permission = Position::where("id", $official->position_id)->first()->permissions()->get(["permission_id"])->pluck("permission_id");
		$permissions = Permission::whereIn("id", $position_permission)->get();
		$official->permissions()->sync($permissions);

		if ($official->wasChanged()) {
			$msg = ["Official Updated", "The official has been successfully updated."];
			return goBackWith("update", $msg);
		}

		return goBackWith();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Official  $official
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Official $official)
	{
		abort_if($request->user()->cannot("event-delete"), 403);
		$request->validate([
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$official->update(["deleted_at" => Carbon::now()]);

		$msg = ["Official Deleted", "The official with the name of " . $official->resident->fullname . " has been deleted."];

		return goBackWith("delete", $msg);
	}
}
