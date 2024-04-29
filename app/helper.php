<?php

use App\Models\Position;
use App\Models\Purok;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

if (!function_exists("isActive")) {
	function isActive(string $uri): bool
	{
		$string = explode("|", $uri);
		return in_array(request()->route()->getName(), $string);
	}
}

if (!function_exists("isLabel")) {
	function isLabel(string $permission): bool
	{
		$permissions = Auth::user()->permissions()->pluck("slug")->toArray();
		return in_array($permission, $permissions);
	}
}

if (!function_exists("verifyMe")) {
	function verifyMe(string $password)
	{
		return password_verify($password, Auth::user()->password);
	}
}

if (!function_exists("goBackWith")) {
	function goBackWith(string $status = null, array $payload = null)
	{
		if ($status && count($payload) > 0) {
			return redirect()->back()->with($status, $payload);
		}
		return redirect()->back();
	}
}

if (!function_exists("ageCalculator")) {
	function ageCalculator($date)
	{
		$parse = Carbon::parse($date)->year;
		$today = Carbon::today()->year;
		return $today - $parse;
	}
}

if (!function_exists("civilStatus")) {
	function civilStatus()
	{
		return [
			"Single",
			"Married",
			"Divorced",
			"Widowed",
			"Separated",
			"Engaged",
			"Domestic Partnership",
			"Civil Union",
			"Common-Law Marriage",
			"Annulled",
		];
	}
}

if (!function_exists("sexs")) {
	function sexs()
	{
		return [
			'Male',
			'Female'
		];
	}
}

if (!function_exists("blotterStatus")) {
	function blotterStatus()
	{
		return [
			"New",
			"Ongoing",
			"Settled",
			"Unsettled"
		];
	}
}

if (!function_exists("getPriorityRange")) {
	function getPriorityRange()
	{
		return Position::count();
	}
}

if (!function_exists("getPurok")) {
	function getPurok()
	{
		return Purok::latest()->get();
	}
}

if (!function_exists("getPurokById")) {
	function getPurokById($id)
	{
		return Purok::findOrFail($id)?->name;
	}
}
