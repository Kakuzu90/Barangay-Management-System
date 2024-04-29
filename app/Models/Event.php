<?php

namespace App\Models;

use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	use HasFactory, HasDeletedScope;

	protected	$fillable = [
		"title", "body", "for",
		"deleted_at"
	];

	protected $hidden = [
		"created_at", "updated_at", "deleted_at"
	];

	protected $casts = [
		"deleted_at" => "date",
	];
}
