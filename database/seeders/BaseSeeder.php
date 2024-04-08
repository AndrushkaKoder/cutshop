<?php

namespace Database\Seeders;

use App\Exceptions\SeedNotFoundException;
use Illuminate\Database\Eloquent\Model;

class BaseSeeder extends DatabaseSeeder
{
	public function getSeedFile(Model $model)
	{
		$modelTable = $model->getTable();
		$directory = storage_path("seed/{$modelTable}");

		if (is_dir($directory)) {
			$seedArray = $directory . "/{$modelTable}.php";

			try {
				if (is_file($seedArray)) {
					return include $seedArray;
				} else {
					throw new SeedNotFoundException("Сид файл {$seedArray} не найден  ");
				}
			} catch (SeedNotFoundException $exception) {
				die($exception->getMessage());
			}
		}
	}

	public function saveFilesIfExists(object $object, mixed $data): void
	{
		if (!empty($data['cover'])) $object->saveCover($data['cover']);
		if (!empty($data['photos'])) $object->savePhotos($data['photos']);
		if (!empty($data['files'])) $object->saveFiles($data['files']);
	}

}
