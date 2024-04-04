<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurokLeadersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purok_leaders', function (Blueprint $table) {
			$table->id();
			$table->foreignId('resident_id')->constrained()->cascadeOnDelete();
			$table->foreignId('purok_id')->constrained()->cascadeOnDelete();
			$table->date('term_from')->nullable();
			$table->date('term_to')->nullable();
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('purok_leaders');
	}
}
