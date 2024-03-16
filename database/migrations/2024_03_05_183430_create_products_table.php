<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up(): void
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('title', 255);
			$table->string('slug', 255);
			$table->string('description', 255)->nullable();
			$table->text('text')->nullable();
			$table->decimal('price')->default(0);
			$table->decimal('discount_price')->nullable();
			$table->integer('discount_percent')->nullable();
			$table->unsignedInteger('vendor_id');
			$table->tinyInteger('visible')->default(1);
			$table->tinyInteger('sort');
			$table->tinyInteger('in_main')->default(1);
			$table->timestamps();

			$table->foreign('vendor_id')
				->on('vendors')
				->references('id')
				->cascadeOnUpdate();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('products');
	}
};
