<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PositionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$file = File::get("database/data/position.json");
		$json = json_decode($file);

		foreach ($json as $item) {
			Position::create([
				"name" => $item->name,
				"priority" => $item->priority
			]);
		}
	}
}
