<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;

class BaseSeeder extends DatabaseSeeder
{
	public function getSeedFile(Model $model): ?array
	{
		$modelTable = $model->getTable();
		$directory = storage_path("seed/{$modelTable}");

		if (is_dir($directory)) {
			$seedArray = $directory . "/{$modelTable}.php";
			return is_file($seedArray) ? include $seedArray : null;
		}
		return null;
	}

}
