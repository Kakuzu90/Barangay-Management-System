<?php

namespace App\Models;

use App\Scopes\Delete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
	use HasFactory;

	protected $fillable = [
		"phone_number", "event_id", "status"
	];

	protected $hidden = [
		"created_at", "updated_at"
	];

	public function event()
	{
		return $this->belongsTo(Event::class)->withoutGlobalScope(Delete::class);
	}
}
