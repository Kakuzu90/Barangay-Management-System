<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialsPermissionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('officials_permissions', function (Blueprint $table) {
			$table->foreignId('official_id')->constrained("officials", "resident_id")->cascadeOnDelete();
			$table->foreignId('permission_id')->constrained("permissions")->cascadeOnDelete();

			$table->primary(['official_id', 'permission_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('officials_permissions');
	}
}
