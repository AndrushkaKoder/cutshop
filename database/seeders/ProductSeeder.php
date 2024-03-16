<?php

namespace Database\Seeders;

use App\Models\File\SaveFilesTrait;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;

class ProductSeeder extends BaseSeeder
{
	use SaveFilesTrait;

	public function run(): void
	{
		$seedFile = $this->getSeedFile(new Product());

		foreach ($seedFile as $i => $data) {
			$product = new Product();
			$product->fill([
				'title' => $data['title'],
				'description' => $data['description'],
				'text' => $data['text'],
				'price' => $data['price'],
				'vendor_id' => $this->saveVendor($data['vendor']),
				'sort' => $i + 1,
			])->save();
			if (!empty($data['cover'])) $this->saveCover($product, $data);
			if (!empty($data['photos'])) $this->savePhotos($product, $data);

			$this->saveCategories($product, $data);
		}
	}

	private function saveVendor(string $vendorName): int
	{
		return Vendor::query()->whereTitle($vendorName)->firstOrFail()->id;
	}

	private function saveCategories($product, $data): void
	{
		$categories = str_contains($data['categories'], '//') ? explode('//', $data['categories']) : [$data['categories']];

		$ids = array_map(function ($categoryName) {
			return Category::query()->whereTitle($categoryName)->firstOrFail()->id;
		}, $categories);

		$product->categories()->sync($ids);
	}

}
