<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PositionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("position-index"), 403);
		$positions = Position::exceptAdmin()->latest()->get();
		return view("pages.position", compact("positions"));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort_if($request->user()->cannot("position-store"), 403);
		$request->validate([
			"name" => ["required", new UniqueEntry("positions", "name")],
			"order" => "required|numeric"
		]);

		Position::create([
			"name" => $request->name,
			"priority" => $request->order
		]);

		$msg = ["Position Added", "New position has been successfully added."];

		return goBackWith("success", $msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Position  $position
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, Position $position)
	{
		abort_if($request->user()->cannot("position-index"), 403);
		return $position;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Position  $position
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Position $position)
	{
		abort_if($request->user()->cannot("position-update"), 403);
		$request->validate([
			"name" => ["required", new UniqueEntry("positions", "name", $position->id)],
			"order" => "required|numeric"
		]);

		$position->update([
			"name" => $request->name,
			"priority" => $request->order
		]);

		if ($position->wasChanged()) {
			$msg = ["Position Updated", "The position has been successfully updated."];
			return goBackWith("update", $msg);
		}

		return goBackWith();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Position  $position
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Position $position)
	{
		abort_if($request->user()->cannot("event-delete"), 403);
		$request->validate([
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$position->update(["deleted_at" => Carbon::now()]);

		$msg = ["Position Deleted", "The position with the name of " . $position->name . " has been deleted."];

		return goBackWith("delete", $msg);
	}
}
