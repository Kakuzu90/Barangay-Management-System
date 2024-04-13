<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificateController extends Controller
{
	public function index(Request $request)
	{
		abort_if($request->user()->cannot("clearance-certificate"), 403);
		return view("pages.certificate.clearance");
	}

	public function birth(Request $request)
	{
		abort_if($request->user()->cannot("birth-certificate"), 403);
		return view("pages.certificate.birth");
	}

	public function cattle(Request $request)
	{
		abort_if($request->user()->cannot("large-cattle-certificate"), 403);
		return view("pages.certificate.cattle");
	}

	public function residence(Request $request)
	{
		abort_if($request->user()->cannot("residence-certificate"), 403);
		return view("pages.certificate.residence");
	}

	public function sports(Request $request)
	{
		abort_if($request->user()->cannot("residence-sports-certificate"), 403);
		return view("pages.certificate.sports");
	}
}
