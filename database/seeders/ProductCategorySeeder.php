<?php

namespace Database\Seeders;

use App\Models\ProductCategory;

class ProductCategorySeeder extends BaseSeeder
{

	public function run(): void
	{
		$seedFile = $this->getSeedFile(new ProductCategory());

		$sort = 1;
		foreach ($seedFile as $i => $data) {
			$category = new ProductCategory();
			$category->fill([
				'title' => $data['title'],
				'sort' => $sort,
			]);
			$category->save();
			$sort++;
		}
	}
}
