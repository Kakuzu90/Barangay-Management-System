<?php

namespace App\Http\Controllers;

use App\Models\Blotter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlotterController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("blotter-index"), 403);
		$data["blotters"] = Blotter::latest()->get();
		return view("pages.blotter.index", compact("data"));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request)
	{
		abort_if($request->user()->cannot("blotter-store"), 403);
		return view("pages.blotter.create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort_if($request->user()->cannot("blotter-store"), 403);
		$request->validate([
			"complaint" => "required|numeric",
			"respondent" => "required|numeric",
			"date_hearing" => "nullable|date|date_format:Y-m-d",
			"incident_location" => "required",
			"incident_date" => "required|date|date_format:Y-m-d",
			"status" => "required",
		]);

		Blotter::create([
			"complainant_id" => $request->complaint,
			"respondent_id" => $request->respondent,
			"involves" => $request->involves,
			"date_hearing" => $request->date_hearing,
			"incident_location" => $request->incident_location,
			"incident_date" => $request->incident_date,
			"status" => $request->status
		]);

		$msg = ["Blotter Added", "New blotter has been successfully added."];

		return goBackWith("success", $msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Blotter  $blotter
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, Blotter $blotter)
	{
		abort_if($request->user()->cannot("blotter-index"), 403);
		return $blotter;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Blotter  $blotter
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, Blotter $blotter)
	{
		abort_if($request->user()->cannot("blotter-update"), 403);
		return view("pages.blotter.edit", compact("blotter"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Blotter  $blotter
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Blotter $blotter)
	{
		abort_if($request->user()->cannot("blotter-update"), 403);
		$request->validate([
			"complaint" => "required|numeric",
			"respondent" => "required|numeric",
			"date_hearing" => "nullable|date|date_format:Y-m-d",
			"incident_location" => "required",
			"incident_date" => "required|date|date_format:Y-m-d",
			"status" => "required",
			"results" => "required",
		]);

		$array = [
			"complainant_id" => $request->complaint,
			"respondent_id" => $request->respondent,
			"involves" => $request->involves,
			"date_hearing" => $request->date_hearing,
			"incident_location" => $request->incident_location,
			"incident_date" => $request->incident_date,
			"status" => $request->status,
			"results" => $request->results
		];

		if ($request->filled("involves")) {
			$array["involves"] = $request->involves;
		}

		$blotter->update($array);

		if ($blotter->wasChanged()) {
			$msg = ["Blotter Updated", "The blotter has been successfully updated."];
			return goBackWith("update", $msg);
		}

		return goBackWith();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Blotter  $blotter
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Blotter $blotter)
	{
		abort_if($request->user()->cannot("blotter-delete"), 403);
		$request->validate([
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$blotter->update(["deleted_at" => Carbon::now()]);

		$msg = ["Blotter Deleted", "The blotter with the complainant name  " . $blotter->complaint->fullname . " has been deleted."];

		return goBackWith("delete", $msg);
	}
}
