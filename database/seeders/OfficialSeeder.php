<?php

namespace Database\Seeders;

use App\Models\Official;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class OfficialSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$file = File::get("database/data/official.json");
		$json = json_decode($file);

		foreach ($json as $item) {
			Official::create([
				"resident_id" => $item->resident_id,
				"username" => $item->username,
				"password" => $item->password,
				"position_id" => $item->position_id,
				"account_status" => $item->account_status,
				"term_from" => Carbon::now(),
				"term_to" => Carbon::now()->addYear(),
			]);
		}
	}
}
