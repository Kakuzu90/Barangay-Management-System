<?php

namespace Database\Seeders;

use App\Models\Resident;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ResidentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$file = File::get("database/data/resident.json");
		$json = json_decode($file);

		foreach ($json as $item) {
			Resident::create([
				"first_name" => $item->first_name,
				"middle_name" => $item->middle_name,
				"last_name" => $item->last_name
			]);
		}
	}
}
