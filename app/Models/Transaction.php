<?php

namespace App\Models;

use App\Scopes\Delete;
use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	use HasFactory, HasDeletedScope;

	protected $fillable = [
		"resident_id", "official_id", "type",
		"or_number", "purpose", "deleted_at"
	];

	protected $hidden = [
		"created_at", "updated_at", "deleted_at"
	];

	protected $casts = [
		"deleted_at" => "date"
	];

	public function resident()
	{
		return $this->belongsTo(Resident::class)->withoutGlobalScope(Delete::class);
	}

	public function official()
	{
		return $this->belongsTo(Official::class, "official_id", "resident_id")->withoutGlobalScope(Delete::class);
	}
}
