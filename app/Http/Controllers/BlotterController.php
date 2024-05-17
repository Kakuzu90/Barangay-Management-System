<?php

namespace App\Http\Controllers;

use App\Models\Blotter;
use App\Models\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;

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
			"results" => "required",
			"incident_location" => "required",
			"incident_date" => "required|date|date_format:Y-m-d",
		]);

		if ($request->filled("involves")) {
			$decode = json_decode($request->involves, true);
			$value = array_column($decode, "value");
			$implode = implode(",", $value);
		}

		Blotter::create([
			"complainant_id" => $request->complaint,
			"respondent_id" => $request->respondent,
			"involves" => $implode ?? NULL,
			"time_hearing" => $request->time_hearing,
			"date_hearing" => $request->date_hearing,
			"incident_location" => $request->incident_location,
			"incident_date" => $request->incident_date,
			"status" => "New",
			"results" => $request->results,
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
		abort_if($request->user()->cannot("blotter-show"), 403);
		return view("pages.blotter.show", compact("blotter"));
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
			"time_hearing" => $request->time_hearing,
			"date_hearing" => $request->date_hearing,
			"incident_location" => $request->incident_location,
			"incident_date" => $request->incident_date,
			"status" => $request->status,
			"results" => $request->results
		];

		if ($request->filled("involves")) {
			$decode = json_decode($request->involves, true);
			$value = array_column($decode, "value");
			$implode = implode(",", $value);
			$array["involves"] = $implode ?? NULL;
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

	public function generate(Request $request, Blotter $blotter)
	{
		abort_if($request->user()->cannot("blotter-index"), 403);

		$official = Official::activeCaptain()->first();
		$captain = strtoupper($official->resident->fullname);
		$today = Carbon::now();
		$day = $today->format('jS');
		$month = $today->format('F');
		$year = $today->year;

		$template = new TemplateProcessor(storage_path("app/public/templates/template-summon.docx"));
		$filename = storage_path("app/public/templates/temp/" . $blotter->respondent->fullname . ".docx");

		$template->setValue("complaint", $blotter->complaint->fullname);
		$template->setValue("c_address", $blotter->complaint->address);
		$template->setValue("respondent", $blotter->respondent->fullname);
		$template->setValue("r_address", $blotter->respondent->address);

		$template->setValue("d_day", $blotter->date_hearing->format("d") ?? "-");
		$template->setValue("d_month", $blotter->date_hearing->format("F") ?? "-");
		$template->setValue("d_year", $blotter->date_hearing->format("Y") ?? "-");
		$template->setValue("time", $blotter->time_hearing ?? "-");

		if (strpos($blotter->time_hearing, "PM") !== false) {
			$timeday = "Afternoon";
		} else {
			$timeday = "Morning";
		}

		$template->setValue("timeday", $timeday);

		$template->setValue("captain", $captain);
		$template->setValue("day", $day);
		$template->setValue("month", $month);
		$template->setValue("year", $year);

		$template->setValue("date_received", $today->format("F d, Y"));
		$template->setValue("date_hearing", $blotter->date_hearing->format("F d, Y"));

		$template->saveAs($filename);
		return response()->download($filename)->deleteFileAfterSend();
	}
}
