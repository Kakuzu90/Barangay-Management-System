<?php

namespace App\Http\Controllers;

use App\Models\Purok;
use App\Models\PurokLeader;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PurokLeaderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("purok-leader-index"), 403);
		$data["puroks"] = Purok::latest()->get();
		$data["leaders"] = PurokLeader::latest()->get();
		return view("pages.purok-leader.index", compact("data"));
	}

	public function active(Request $request)
	{
		abort_if($request->user()->cannot("purok-leader-index"), 403);
		$data["leaders"] = PurokLeader::active()->latest()->get();
		return view("pages.purok-leader.index", compact("data"));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort_if($request->user()->cannot("purok-leader-store"), 403);
		$request->validate([
			"resident" => "required|numeric",
			"purok" => "required|numeric",
			"date_from" => "required|date|date_format:Y-m-d",
			"date_to" => "required|date|date_format:Y-m-d",
		]);

		if (PurokLeader::hasConflictLeader($request->only("date_from", "date_to", "purok"))) {
			return goBackWith()->withErrors(["conflict" => "Each purok can have only one designated leader!"]);
		}

		PurokLeader::create([
			"resident_id" => $request->resident,
			"purok_id" => $request->purok,
			"term_from" => $request->date_from,
			"term_to" => $request->date_to
		]);

		$msg = ["Purok Leader Added", "New purok leader has been successfully added."];

		return goBackWith("success", $msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\PurokLeader  $purokLeader
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, PurokLeader $purokLeader)
	{
		abort_if($request->user()->cannot("purok-leader-index"), 403);
		return $purokLeader;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\PurokLeader  $purokLeader
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, PurokLeader $purokLeader)
	{
		abort_if($request->user()->cannot("purok-leader-update"), 403);
		$request->validate([
			"resident" => "required|numeric",
			"purok" => "required|numeric",
			"date_from" => "required|date|date_format:Y-m-d",
			"date_to" => "required|date|date_format:Y-m-d",
		]);

		$conflict = PurokLeader::hasConflictLeader($request->only("date_from", "date_to", "purok"))->first();
		if ($conflict && $conflict->id !== $purokLeader->id) {
			return goBackWith()->withErrors(["conflict" => "Each purok can have only one designated leader!"]);
		}

		$purokLeader->update([
			"resident_id" => $request->resident,
			"purok_id" => $request->purok,
			"term_from" => $request->date_from,
			"term_to" => $request->date_to
		]);

		if ($purokLeader->wasChanged()) {
			$msg = ["Purok Leader Updated", "The purok leader has been successfully updated."];
			return goBackWith("update", $msg);
		}

		return goBackWith();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\PurokLeader  $purokLeader
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, PurokLeader $purokLeader)
	{
		abort_if($request->user()->cannot("resident-delete"), 403);
		$request->validate([
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$purokLeader->update(["deleted_at" => Carbon::now()]);

		$msg = ["Purok Leader Deleted", "The purok leader with the name of " . $purokLeader->resident->fullname . " has been deleted."];

		return goBackWith("delete", $msg);
	}
}
