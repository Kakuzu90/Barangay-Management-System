<?php

namespace App\Models;

use App\Scopes\Delete;
use App\Traits\HasDeletedScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Official extends Authenticatable
{
	use HasFactory, HasDeletedScope;

	protected $fillable = [
		"resident_id", "username", "password",
		"position_id", "term_from", "term_to",
		"account_status", "deleted_at"
	];

	protected $hidden = [
		"created_at", "updated_at", "deleted_at", "remember_token"
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

	public function position()
	{
		return $this->belongsTo(Position::class)->withoutGlobalScope(Delete::class);
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, "officials_permissions");
	}

	public function hasPermission($permission)
	{
		return (bool) $this->permissions()->where("slug", $permission)->exists();
	}

	public function setPasswordAttribute($value)
	{
		return $this->attributes["password"] = Hash::make($value);
	}

	public function scopeExceptAdmin($query)
	{
		return $query->where("id", 1); // 1 is for admin
	}

	public function scopeActive($query)
	{
		return $query->whereDate("term_from", "<=", Carbon::today())
			->whereDate("term_to", ">=", Carbon::today());
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

	public function isOnTerm()
	{
		return Carbon::now()->between($this->term_from, $this->term_to) && $this->account_status === 2;
	}

	public function isNotAdmin()
	{
		return $this->position_id !== 1; // 1 = Admin
	}
}
