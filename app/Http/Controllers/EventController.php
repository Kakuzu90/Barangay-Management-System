<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("event-index"), 403);
		$events = Event::latest()->get();
		return view("pages.event", compact("events"));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort_if($request->user()->cannot("event-store"), 403);
		$request->validate([
			"title" => "required",
			"body" => "required",
			"for" => "required|array"
		]);

		if ($request->filled("notify")) {
			// send sms notification here
		}

		Event::create([
			"title" => $request->title,
			"body" => $request->body,
			"for" => json_encode($request->for),
		]);

		$msg = ["Event Added", "New event has been successfully added."];

		return goBackWith("success", $msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, Event $event)
	{
		abort_if($request->user()->cannot("event-index"), 403);
		return [
			"title" => $event->title,
			"body" => $event->body,
			"for" => json_decode($event->for),
		];
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Event $event)
	{
		abort_if($request->user()->cannot("event-update"), 403);
		$request->validate([
			"title" => "required",
			"body" => "required",
			"for" => "required|array"
		]);

		if ($request->filled("notify")) {
			// send sms notification here
		}

		$event->update([
			"title" => $request->title,
			"body" => $request->body,
			"for" => json_encode($request->for),
		]);

		if ($event->wasChanged()) {
			$msg = ["Event Updated", "The event has been successfully updated."];
			return goBackWith("update", $msg);
		}
		return goBackWith();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Event $event)
	{
		abort_if($request->user()->cannot("event-delete"), 403);
		$request->validate([
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$event->update(["deleted_at" => Carbon::now()]);

		$msg = ["Event Deleted", "The event with the title of " . $event->title . " has been deleted."];

		return goBackWith("delete", $msg);
	}
}
