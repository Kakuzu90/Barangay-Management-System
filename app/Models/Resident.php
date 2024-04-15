<?php

namespace App\Models;

use App\Scopes\Delete;
use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
	use HasFactory, HasDeletedScope;

	protected $fillable = [
		"first_name", "middle_name", "last_name", "maiden_name",
		"nickname", "phone_number", "age", "date_birth", "place_birth",
		"gender", "civil_status", "mother_name", "father_name", "citizenship",
		"education_level", "purok_id", "contact_person", "contact_address",
		"address", "deleted_at"
	];

	protected $hidden = [
		"created_at", "updated_at", "deleted_at"
	];

	protected $casts = [
		"date_birth" => "date",
		"deleted_at" => "date"
	];

	public function purok()
	{
		return $this->belongsTo(Purok::class)->withoutGlobalScope(Delete::class);
	}

	public function scopeExceptAdmin($query)
	{
		return $query->where("id", "!=", 1); // 1 is for admin
	}

	public function setFirstNameAttribute($value)
	{
		return $this->attributes["first_name"] = strtolower($value);
	}

	public function setMiddleNameAttribute($value)
	{
		return $this->attributes["middle_name"] = strtolower($value);
	}

	public function setLastNameAttribute($value)
	{
		return $this->attributes["last_name"] = strtolower($value);
	}

	public function setGenderAttribute($value)
	{
		return $this->attributes["gender"] = strtolower($value);
	}

	public function setCivilStatusAttribute($value)
	{
		return $this->attributes["civil_status"] = strtolower($value);
	}

	public function setEducationLevelAttribute($value)
	{
		return $this->attributes["education_level"] = strtolower($value);
	}

	public function getFirstNameAttribute($value)
	{
		return $this->attributes["first_name"] = ucwords($value);
	}

	public function getMiddleNameAttribute($value)
	{
		return $this->attributes["middle_name"] = ucwords($value);
	}

	public function getLastNameAttribute($value)
	{
		return $this->attributes["last_name"] = ucwords($value);
	}

	public function getFullNameAttribute()
	{
		return $this->first_name . " " . $this->middle_name[0] . ". " . $this->last_name;
	}

	public function getGenderAttribute($value)
	{
		return $this->attributes["gender"] = ucwords($value);
	}

	public function getCivilStatusAttribute($value)
	{
		return $this->attributes["civil_status"] = ucwords($value);
	}

	public function getEducationLevelAttribute($value)
	{
		return $this->attributes["education_level"] = ucwords($value);
	}

	public function isMale()
	{
		return strtolower($this->gender) === "male";
	}

	public function isFemale()
	{
		return strtolower($this->gender) === "female";
	}

	public function isAdmin()
	{
		return $this->id === 1;
	}

	public function avatar()
	{
		return route("api.avatar", $this->id);
	}
}
