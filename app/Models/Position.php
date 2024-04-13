<?php

namespace App\Models;

use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
	use HasFactory, HasDeletedScope;

	protected $fillable = [
		"name", "priority", "deleted_at"
	];

	protected $hidden = [
		"created_at", "updated_at", "deleted_at"
	];

	public function officials()
	{
		return $this->hasMany(Official::class);
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, "positions_permissions");
	}

	public function scopeExceptAdmin($query)
	{
		return $query->where("id", "!=", 1); // 1 is for admin position
	}

	public function setNameAttribute($value)
	{
		return $this->attributes["name"] = strtolower($value);
	}

	public function getNameAttribute($value)
	{
		return $this->attributes["name"] = ucwords($value);
	}

	public function isAdmin()
	{
		return $this->id === 1;
	}
}
