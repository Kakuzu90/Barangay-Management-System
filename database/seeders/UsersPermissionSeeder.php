<?php

namespace Database\Seeders;

use App\Models\Official;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UsersPermissionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$admin = Official::where("resident_id", 1)->first();

		$permissions = Permission::all();

		$admin->permissions()->saveMany($permissions);
	}
}
