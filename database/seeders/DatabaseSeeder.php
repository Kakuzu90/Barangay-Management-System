<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call([
			PositionSeeder::class,
			PurokSeeder::class,
			SettingSeeder::class,
			PermissionSeeder::class,
			ResidentSeeder::class,
			OfficialSeeder::class,
			UsersPermissionSeeder::class,
			PositionsPermissions::class,
		]);
	}
}
