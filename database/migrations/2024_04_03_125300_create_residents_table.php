<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('residents', function (Blueprint $table) {
			$table->id();
			$table->string('first_name');
			$table->string('middle_name');
			$table->string('last_name');
			$table->string('maiden_name')->nullable();
			$table->string('nickname')->nullable();
			$table->string('phone_number')->nullable();
			$table->string('age')->nullable();
			$table->date('date_birth')->nullable();
			$table->text('place_birth')->nullable();
			$table->string('gender')->nullable();
			$table->string('citizenship')->nullable();
			$table->string('civil_status')->nullable();
			$table->text('mother_name')->nullable();
			$table->text('father_name')->nullable();
			$table->text('education_level')->nullable();
			$table->foreignId('purok_id')->nullable()->constrained()->cascadeOnDelete();
			$table->text('contact_person')->nullable();
			$table->text('contact_address')->nullable();
			$table->text('address')->nullable();
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
		Schema::dropIfExists('residents');
	}
}
