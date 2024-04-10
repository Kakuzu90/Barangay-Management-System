<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsPermissions extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$capitan = Position::where("id", 2)->first();
		$kagawad = Position::where("id", 3)->first();
		$sk_chairman = Position::where("id", 4)->first();
		$sk_kagawad = Position::where("id", 5)->first();
		$secretary = Position::where("id", 6)->first();

		$capitan_permissions = Permission::whereNotIn("slug", [
			"purok-index", "purok-store", "purok-update", "purok-delete",
			"position-index", "position-store", "position-update", "position-delete", "position-permissions"
		])->get();
		$kagawad_secretary_permissions = Permission::whereIn("slug", [
			"dashboard-index",
			"event-index", "purok-leader-index", "resident-index", "resident-store",
			"resident-update", "resident-delete", "resident-show", "blotter-index",
			"blotter-store", "blotter-update", "blotter-delete", "barangay-official-index",
			"clearance-certificate", "birth-certificate", "large-cattle-certificate", "residence-certificate",
			"residence-sports-certificate", "profile-settings"
		])->get();

		$sk_chairman_permissions = Permission::whereIn("slug", [
			"dashboard-index",
			"event-index", "purok-leader-index", "resident-index", "resident-store",
			"resident-update", "barangay-official-index", "blotter-index"
		])->get();

		$sk_kagawad_permissions = Permission::whereIn("slug", [
			"dashboard-index",
			"event-index", "purok-leader-index", "resident-index",
			"barangay-official-index", "blotter-index"
		])->get();

		$capitan->permissions()->saveMany($capitan_permissions);
		$kagawad->permissions()->saveMany($kagawad_secretary_permissions);
		$secretary->permissions()->saveMany($kagawad_secretary_permissions);
		$sk_chairman->permissions()->saveMany($sk_chairman_permissions);
		$sk_kagawad->permissions()->saveMany($sk_kagawad_permissions);
	}
}
