<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up(): void
	{
		Schema::create('vendors', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->string('slug', 255);
			$table->tinyInteger('visible')->default(1);
			$table->tinyInteger('in_main')->default(1);
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('vendors');
	}
};
