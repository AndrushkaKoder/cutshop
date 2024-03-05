<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up(): void
	{
		Schema::create('products', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->string('slug', 255);
			$table->string('description', 255)->nullable();
			$table->text('text')->nullable();
			$table->unsignedInteger('price');
			$table->unsignedInteger('vendor_id');
			$table->tinyInteger('visible');
			$table->tinyInteger('sort');
			$table->tinyInteger('in_main');
			$table->timestamps();

			$table->foreign('vendor_id')
				->on('vendors')
				->references('id')
				->cascadeOnUpdate()
				->cascadeOnDelete();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('products');
	}
};
