<?php

namespace App\Http\Controllers;

use App\Models\Purok;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PurokController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("purok-index"), 403);
		$puroks = Purok::latest()->get();
		return view("pages.purok", compact("puroks"));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort_if($request->user()->cannot("purok-store"), 403);
		$request->validate([
			"name" => ["required", new UniqueEntry("puroks", "name")]
		]);

		Purok::create([
			"name" => $request->name
		]);

		$msg = ["Purok Added", "New purok has been successfully added."];

		return goBackWith("success", $msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Purok  $purok
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, Purok $purok)
	{
		abort_if($request->user()->cannot("purok-index"), 403);
		return $purok;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Purok  $purok
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Purok $purok)
	{
		abort_if($request->user()->cannot("purok-update"), 403);
		$request->validate([
			"name" => ["required", new UniqueEntry("puroks", "name", $purok->id)]
		]);

		$purok->update([
			"name" => $request->name
		]);

		if ($purok->wasChanged()) {
			$msg = ["Purok Updated", "The purok has been successfully updated."];
			return goBackWith("update", $msg);
		}
		return goBackWith();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Purok  $purok
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Purok $purok)
	{
		abort_if($request->user()->cannot("event-delete"), 403);
		$request->validate([
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$purok->update(["deleted_at" => Carbon::now()]);

		$msg = ["Purok Deleted", "The purok with the name of " . $purok->name . " has been deleted."];

		return goBackWith("delete", $msg);
	}
}
