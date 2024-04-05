<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PermissionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$file = File::get("database/data/permission.json");
		$json = json_decode($file);

		foreach ($json as $item) {
			Permission::create([
				"name" => $item->name
			]);
		}
	}
}
