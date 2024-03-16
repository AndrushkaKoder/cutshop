<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up(): void
	{
		Schema::create('category_product', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedBigInteger('category_id');
			$table->unsignedBigInteger('product_id');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('category_product');
	}
};
