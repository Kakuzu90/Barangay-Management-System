<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function search(Request $request)
	{
		abort_if($request->user()->cannot("resident-index"), 403);

		$search = $request->input("search");
		$results = Resident::where("last_name", "LIKE", "%$search%")->orderBy("last_name", "asc")->get();

		return $results->map(function ($row) {
			return ["id" => $row->id, "fullname" => $row->fullname, "avatar" => $row->avatar(), "purok" => $row->purok->name];
		});
	}
}
