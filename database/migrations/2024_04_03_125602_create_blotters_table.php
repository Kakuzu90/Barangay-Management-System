<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlottersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blotters', function (Blueprint $table) {
			$table->id();
			$table->foreignId('complainant_id')->constrained('residents')->cascadeOnDelete();
			$table->foreignId('respondent_id')->constrained('residents')->cascadeOnDelete();
			$table->text('involves')->nullable();
			$table->string('time_hearing')->nullable();
			$table->date('date_hearing')->nullable();
			$table->text('incident_location')->nullable();
			$table->date('incident_date')->nullable();
			$table->string('status')->nullable();
			$table->text('results')->nullable();
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
		Schema::dropIfExists('blotters');
	}
}
