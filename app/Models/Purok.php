<?php

namespace App\Models;

use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purok extends Model
{
	use HasFactory, HasDeletedScope;

	protected $fillable = [
		"name", "deleted_at"
	];

	protected $hidden = [
		"created_at", "updated_at", "deleted_at"
	];

	public function residents()
	{
		return $this->hasMany(Resident::class);
	}

	public function setNameAttribute($value)
	{
		return $this->attributes["name"] = strtolower($value);
	}

	public function getNameAttribute($value)
	{
		return $this->attributes["name"] = ucwords($value);
	}
}
