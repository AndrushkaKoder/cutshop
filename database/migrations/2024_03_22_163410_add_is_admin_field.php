<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	public function up(): void
	{
		Schema::table('users', function (Blueprint $table) {
			$table->tinyInteger('is_admin')->default(0);
		});
	}


	public function down(): void
	{
		if (Schema::hasColumn('users', 'is_admin')) {
			Schema::dropColumns('users', 'is_admin');
		}

	}
};
