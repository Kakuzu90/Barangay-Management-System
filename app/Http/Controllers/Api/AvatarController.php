<?php

namespace App\Http\Controllers\Api;

use App\Models\Resident;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class AvatarController extends Controller
{
	public function index(Request $request, Resident $profile)
	{
		abort_if($request->user()->cannot("resident-index"), 403);
		$path = storage_path("app/public/profile/" . $profile->id . ".png");

		if (!File::exists($path)) {
			if ($profile->isMale() && !$profile->isAdmin()) {
				$path = public_path("assets/images/avatar/male.png");
			} else if ($profile->isFemale() && !$profile->isAdmin()) {
				$path = public_path("assets/images/avatar/female.png");
			} else {
				$path = public_path("assets/images/avatar/administrator.png");
			}
		}

		$file = File::get($path);
		$type = File::mimeType($path);

		$response = Response::make($file, 200);
		$response->header("Content-Type", $type);

		return $response;
	}
}
