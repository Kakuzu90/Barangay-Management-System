<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('officials', function (Blueprint $table) {
			$table->id();
			$table->foreignId('resident_id')->constrained()->cascadeOnDelete();
			$table->string('username');
			$table->string('password');
			$table->foreignId('position_id')->constrained()->cascadeOnDelete();
			$table->date('term_from')->nullable();
			$table->date('term_to')->nullable();
			$table->integer('account_status')->default(1);
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
		Schema::dropIfExists('officials');
	}
}
