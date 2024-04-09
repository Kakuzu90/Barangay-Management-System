<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsPermissions extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('positions_permissions', function (Blueprint $table) {
			$table->foreignId('position_id')->constrained()->cascadeOnDelete();
			$table->foreignId('permission_id')->constrained()->cascadeOnDelete();

			$table->primary(['position_id', 'permission_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('positions_permissions');
	}
}
