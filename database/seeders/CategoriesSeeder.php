<?php

namespace Database\Seeders;

use App\Models\Category;

class CategoriesSeeder extends BaseSeeder
{

	public function run(): void
	{
		$seedFile = $this->getSeedFile(new Category());
		if ($seedFile) {
			foreach ($seedFile as $i => $data) {
				$sort = Category::query()->max('id') + 1;
				$category = new Category();
				$category->fill([
					'title' => $data['title'],
					'sort' => $sort
				])->save();

				if (isset($data['children'])) {
					$this->recursiveSaveCategories($category, $data['children']);
				}
			}
			Category::fixTree();
		}
	}

	private function recursiveSaveCategories($category, array $children): void
	{
		foreach ($children as $child) {
			$sort = Category::query()->max('id') + 1;
			$childCategory = $category->children()->create([
				'title' => $child['title'],
				'sort' => $sort
			]);
			if (isset($child['children'])) $this->recursiveSaveCategories($childCategory, $child['children']);
		}
	}
}
