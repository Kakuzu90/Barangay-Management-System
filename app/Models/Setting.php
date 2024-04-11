<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	use HasFactory;

	public const MISSION = 1;
	public const VISION = 2;

	protected $fillable = [
		"title", "content"
	];

	protected $hidden = [
		"created_at", "updated_at"
	];

	public function scopeMission($query)
	{
		return $query->where("id", self::MISSION);
	}

	public function scopeVision($query)
	{
		return $query->where("id", self::VISION);
	}

	public function setTitleAttribute($value)
	{
		return $this->attributes["title"] = strtolower($value);
	}

	public function getTitleAttribute($value)
	{
		return $this->attributes["title"] = ucwords($value);
	}
}
