<?php

namespace App\Traits;

use App\Scopes\Delete;

trait HasDeletedScope
{
	public static function bootHasDeletedScope()
	{
		static::addGlobalScope(new Delete());
	}
}
