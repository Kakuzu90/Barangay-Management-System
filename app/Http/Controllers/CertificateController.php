<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\Resident;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;

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

	public function storeIndex(Request $request)
	{
		abort_if($request->user()->cannot("clearance-certificate"), 403);
		$request->validate([
			"or_number" => "required",
			"purpose" => "required",
			"resident" => "required|numeric",
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$transaction = Transaction::create([
			"resident_id" => $request->resident,
			"official_id" => Auth::id(),
			"purpose" => $request->purpose,
			"or_number" => $request->or_number,
			"type" => "Barangay Clearance"
		]);

		$resident = $transaction->resident;
		$official = Official::activeCaptain()->first();
		$captain = strtoupper($official->resident->fullname);
		$today = Carbon::now();
		$day = $today->format('jS');
		$month = $today->format('F');
		$year = $today->year;
		$name = strtoupper($resident->fullname);
		$age = $resident->age;
		$status = strtolower($resident->civil_status);
		$address = $resident->purok->name . ", " . $resident->address;
		$person = $resident->isMale() ? "he" : "she";
		$person1 = $resident->isMale() ? "him" : "her";
		$purpose = strtolower($transaction->purpose);

		$template = new TemplateProcessor(storage_path("app/public/templates/template-clearance.docx"));
		$filename = storage_path("app/public/templates/temp/" . $resident->fullname . ".docx");

		$template->setValue("name", $name);
		$template->setValue("age", $age);
		$template->setValue("status", $status);
		$template->setValue("address", $address);
		$template->setValue("person", $person);
		$template->setValue("purpose", $purpose);
		$template->setValue("person1", $person1);
		$template->setValue("captain", $captain);
		$template->setValue("day", $day);
		$template->setValue("month", $month);
		$template->setValue("year", $year);

		$template->saveAs($filename);
		return response()->download($filename)->deleteFileAfterSend();
	}

	public function storeBirth(Request $request)
	{
		abort_if($request->user()->cannot("birth-certificate"), 403);
		$request->validate([
			"or_number" => "required",
			"resident" => "required|numeric",
			"child" => "required",
			"gender" => "required",
			"date_birth" => "required|date|date_format:Y-m-d",
			"place_birth" => "required",
			"mother" => "required",
			"father" => "required",
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$transaction = Transaction::create([
			"resident_id" => $request->resident,
			"official_id" => Auth::id(),
			"purpose" => "Delayed registration of birth of " . $request->child,
			"or_number" => $request->or_number,
			"type" => "Birth Certification"
		]);

		$resident = $transaction->resident;
		$official = Official::activeCaptain()->first();
		$captain = strtoupper($official->resident->fullname);
		$today = Carbon::now();
		$day = $today->format('jS');
		$month = $today->format('F');
		$year = $today->year;
		$name = $resident->fullname;
		$date = Carbon::parse($request->date_birth);


		$template = new TemplateProcessor(storage_path("app/public/templates/template-birth-certificate.docx"));
		$filename = storage_path("app/public/templates/temp/" . $resident->fullname . ".docx");

		$template->setValue("request", $name);
		$template->setValue("child", $request->child);
		$template->setValue("birth", $date->format("F d, Y"));
		$template->setValue("gender", $request->gender);
		$template->setValue("place", $request->place_birth);
		$template->setValue("father", $request->father);
		$template->setValue("mother", $request->mother);

		$template->setValue("captain", $captain);
		$template->setValue("day", $day);
		$template->setValue("month", $month);
		$template->setValue("year", $year);

		$template->saveAs($filename);
		return response()->download($filename)->deleteFileAfterSend();
	}

	public function storeCattle(Request $request)
	{
		abort_if($request->user()->cannot("large-cattle-certificate"), 403);
		$request->validate([
			"or_number" => "required",
			"witness" => "required|numeric",
			"owner" => "required|numeric",
			"hayop" => "required",
			"kasarian" => "required",
			"edad" => "required",
			"color" => "required",
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$transaction = Transaction::create([
			"resident_id" => $request->owner,
			"official_id" => Auth::id(),
			"purpose" => "Certification of ownership of large cattle",
			"or_number" => $request->or_number,
			"type" => "Large Cattle"
		]);

		$resident = $transaction->resident;
		$official = Official::activeCaptain()->first();
		$witness = Resident::findOrFail($request->witness)->fullname;
		$captain = strtoupper($official->resident->fullname);
		$today = Carbon::now();
		$day = $today->format('jS');
		$month = $today->format('F');
		$year = $today->year;
		$name = $resident->fullname;

		$template = new TemplateProcessor(storage_path("app/public/templates/template-cattle.docx"));
		$filename = storage_path("app/public/templates/temp/" . $resident->fullname . ".docx");

		$template->setValue("owner", $name);
		$template->setValue("witness", $witness);
		$template->setValue("hayop", strtolower($request->hayop));
		$template->setValue("gender", strtolower($request->kasarian));
		$template->setValue("age", $request->edad);
		$template->setValue("color", strtolower($request->color));

		$template->setValue("captain", $captain);
		$template->setValue("day", $day);
		$template->setValue("month", $month);
		$template->setValue("year", $year);

		$template->saveAs($filename);
		return response()->download($filename)->deleteFileAfterSend();
	}

	public function storeResidence(Request $request)
	{
		abort_if($request->user()->cannot("residence-certificate"), 403);
		$request->validate([
			"or_number" => "required",
			"resident" => "required|numeric",
			"living_since" => "required|date|date_format:Y-m-d",
			"purpose" => "required",
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		$transaction = Transaction::create([
			"resident_id" => $request->resident,
			"official_id" => Auth::id(),
			"purpose" => $request->purpose,
			"or_number" => $request->or_number,
			"type" => "Residence Certificate"
		]);

		$resident = $transaction->resident;
		$official = Official::activeCaptain()->first();
		$captain = strtoupper($official->resident->fullname);
		$today = Carbon::now();
		$day = $today->format('jS');
		$month = $today->format('F');
		$year = $today->year;
		$date = Carbon::parse($request->living_since);

		$name = $resident->fullname;
		$person = $resident->isMale() ? "him" : "her";
		$age = $resident->age;
		$address = $resident->purok->name . ", " . $resident->address;
		$gender = $resident->gender;


		$template = new TemplateProcessor(storage_path("app/public/templates/template-residence.docx"));
		$filename = storage_path("app/public/templates/temp/" . $resident->fullname . ".docx");

		$template->setValue("name", $name);
		$template->setValue("age", $age);
		$template->setValue("gender", strtolower($gender));
		$template->setValue("address", $address);
		$template->setValue("person", $person);
		$template->setValue("stay", $date->format("F d, Y"));


		$template->setValue("captain", $captain);
		$template->setValue("day", $day);
		$template->setValue("month", $month);
		$template->setValue("year", $year);

		$template->saveAs($filename);
		return response()->download($filename)->deleteFileAfterSend();
	}

	public function storeSports(Request $request)
	{
		abort_if($request->user()->cannot("residence-sports-certificate"), 403);
		$request->validate([
			"or_number" => "required",
			"resident" => "required|array",
			"purpose" => "required",
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return goBackWith()->withErrors(["verify_password" => "The password is incorrect, please try again!"]);
		}

		foreach ($request->resident as $key => $value) {
			Transaction::create([
				"resident_id" => $key,
				"official_id" => Auth::id(),
				"purpose" => $request->purpose,
				"or_number" => $request->or_number,
				"type" => "Residence Certificate"
			]);
		}

		$official = Official::activeCaptain()->first();
		$captain = strtoupper($official->resident->fullname);
		$today = Carbon::now();
		$day = $today->format('jS');
		$month = $today->format('F');
		$year = $today->year;

		$template = new TemplateProcessor(storage_path("app/public/templates/template-residence-sports.docx"));
		$filename = storage_path("app/public/templates/temp/sports.docx");

		$template->cloneRow("name", count($request->resident));
		$i = 1;
		foreach ($request->resident as $key => $value) {
			$template->setValue("name#" . $i, $value["name"]);
			$template->setValue("precinct#" . $i, $value["precinct"]);
			$i++;
		}
		$template->setValue("purpose", strtolower($request->purpose));
		$template->setValue("captain", $captain);
		$template->setValue("day", $day);
		$template->setValue("month", $month);
		$template->setValue("year", $year);

		$template->saveAs($filename);
		return response()->download($filename)->deleteFileAfterSend();
	}
}
