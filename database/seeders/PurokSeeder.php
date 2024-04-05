<?php

namespace Database\Seeders;

use App\Models\Purok;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PurokSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$file = File::get("database/data/purok.json");
		$json = json_decode($file);

		foreach ($json as $item) {
			Purok::create([
				"name" => $item->name
			]);
		}
	}
}
