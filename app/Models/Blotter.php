<?php

namespace App\Models;

use App\Scopes\Delete;
use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
	use HasFactory, HasDeletedScope;

	protected $fillable = [
		"complainant_id", "respondent_id", "involves", "time_hearing",
		"date_hearing", "incident_location", "incident_date",
		"status", "results", "deleted_at"
	];

	protected $hidden = [
		"created_at", "updated_at", "deleted_at"
	];

	protected $casts = [
		"date_hearing" => "date",
		"incident_date" => "date",
		"deleted_at" => "date"
	];

	public function complaint()
	{
		return $this->belongsTo(Resident::class, "complainant_id", "id")->withoutGlobalScope(Delete::class);
	}

	public function respondent()
	{
		return $this->belongsTo(Resident::class, "respondent_id", "id")->withoutGlobalScope(Delete::class);
	}

	public function setStatusAttribute($value)
	{
		return $this->attributes["status"] = strtolower($value);
	}

	public function getStatusAttribute($value)
	{
		return $this->attributes["status"] = ucwords($value);
	}

	public function color()
	{
		if (strtolower($this->status) === "new") {
			return "primary";
		}
		if (strtolower($this->status) === "ongoing") {
			return "warning";
		}
		if (strtolower($this->status) === "settled") {
			return "success";
		}
		if (strtolower($this->status) === "unsettled") {
			return "danger";
		}
	}

	public function involvesArray()
	{
		return ($this->involves) ? explode(",", $this->involves) : 0;
	}
}
