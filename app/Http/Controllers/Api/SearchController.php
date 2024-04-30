<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blotter;
use App\Models\Resident;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function search(Request $request)
	{
		abort_if($request->user()->cannot("resident-index"), 403);

		$search = $request->input("search");
		$results = Resident::exceptAdmin()->where("last_name", "LIKE", "%$search%")->orderBy("last_name", "asc")->get();

		return $results->map(function ($row) {
			return ["id" => $row->id, "text" => $row->fullname, "avatar" => $row->avatar(), "purok" => $row->purok->name];
		});
	}

	public function hasPending(Request $request, Resident $resident)
	{
		abort_if($request->user()->cannot("resident-index"), 403);

		$pending = Blotter::where(function ($query) use ($resident) {
			$lastname = $resident->last_name;
			$query->where("complainant_id", $resident->id)
				->orWhere("respondent_id", $resident->id)
				->orWhere("involves", "LIKE", "%$lastname%");
		})
			->whereIn("status", ["new", "ongoing"])
			->first();

		if ($pending) {
			return response()->json([
				"status" => false,
				"link" => route("blotters.edit", $pending->id),
				"resident" => $resident->fullname . " has a pending case involved!",
				"name" => $resident->fullname,
				"avatar" => $resident->avatar(),
				"age" => $resident->age,
				"gender" => $resident->gender,
			]);
		}

		return response()->json([
			"status" => true,
			"resident" => $resident->fullname . " has no pending case involved!",
			"name" => $resident->fullname,
			"avatar" => $resident->avatar(),
			"age" => $resident->age,
			"gender" => $resident->gender,
		]);
	}
}
