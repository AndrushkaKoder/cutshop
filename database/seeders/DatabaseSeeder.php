<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

	public function run(): void
	{
		$this->call(ParamsSeeder::class);
		$this->call(VendorSeeder::class);
		$this->call(ProductCategorySeeder::class);
		$this->call(ProductSeeder::class);
	}
}
