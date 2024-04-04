<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
	use HasFactory;

	public $timestamps = false;

	protected $fillable = [
		"name", "slug"
	];

	protected static function boot()
	{
		parent::boot();

		static::creating(function ($permission) {
			$permission->slug = Str::slug($permission->name);
		});

		static::updating(function ($permission) {
			$permission->slug = Str::slug($permission->slug);
		});
	}
}
