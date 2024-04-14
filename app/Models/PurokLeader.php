<?php

namespace App\Models;

use App\Scopes\Delete;
use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PurokLeader extends Model
{
	use HasFactory, HasDeletedScope;

	protected $fillable = [
		"resident_id", "purok_id", "term_from",
		"term_to", "deleted_at"
	];

	protected $hidden = [
		"created_at", "updated_at", "deleted_at"
	];

	protected $casts = [
		"term_from" => "date",
		"term_to" => "date",
		"deleted_at" => "date"
	];

	public function resident()
	{
		return $this->belongsTo(Resident::class)->withoutGlobalScope(Delete::class);
	}

	public function purok()
	{
		return $this->belongsTo(Purok::class)->withoutGlobalScope(Delete::class);
	}

	public function scopeActive($query)
	{
		return $query->whereDate("term_from", "<=", Carbon::today())
			->whereDate("term_to", ">=", Carbon::today());
	}

	public function scopeHasConflictLeaders($query, $request)
	{
		return $query->where(function ($query) use ($request) {
			$query->whereBetween('term_from', [$request["date_from"], $request["date_to"]])
				->orWhereBetween('term_to', [$request["date_from"], $request["date_to"]])
				->orWhere(function ($query) use ($request) {
					$query->where('term_from', '<=', $request["date_from"])
						->where('term_to', '>=', $request["date_to"]);
				});
		})->where("purok_id", $request["purok"]);
	}

	public function text()
	{
		if (Carbon::now()->between($this->term_from, $this->term_to)) {
			return "Active";
		}
		return "Inactive";
	}

	public function color()
	{
		if (Carbon::now()->between($this->term_from, $this->term_to)) {
			return "success";
		}
		return "warning";
	}
}
