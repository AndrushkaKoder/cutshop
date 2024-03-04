<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('params', function (Blueprint $table) {
			$table->increments('id');
			$table->string('sitename', 50);
			$table->string('telegram', 50)->nullable()->default('null');
			$table->string('email', 50)->nullable()->default('null');
			$table->string('phone', 15)->nullable()->default('null');
			$table->string('locate')->default('ru');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('params');
	}
};
