<?php

namespace App\Models\File;

use Illuminate\Support\Facades\Storage;

trait SaveFilesTrait
{
	public function saveCover(object $object, array $data): void
	{
		$cover = $data['cover'];
		$extension = $this->getExtension($cover);
		$filename = md5($cover) . '.' . $extension;
		$pathToSave = 'public/' . get_class($object) . '/' . $object->id . '/cover';

		if (!is_dir($pathToSave)) Storage::makeDirectory($pathToSave);

		$this->save($object,
			$pathToSave . "/{$filename}",
			$filename,
			file_get_contents(
				str_contains($cover, 'http')
					?
					$cover
					:
					storage_path('seed/' . $object->getTable() . '/' . $cover)
			));
	}

	public function savePhotos(object $object, array $data): void
	{
		$photos = $data['photos'];

		$pathToPhotos = storage_path('seed/' . $object->getTable() . '/' . $photos);

		if (is_dir($pathToPhotos)) {
			$photosArray = scandir($pathToPhotos);
			if (count($photosArray) > 2) {
				foreach ($photosArray as $i => $file) {
					if ($i === 0 || $i === 1) continue;
					$extension = $this->getExtension($file);
					$filename = md5($file) . '.' . $extension;
					$pathToSave = 'public/' . get_class($object) . '/' . $object->id . '/photos';

					if (!is_dir($pathToSave)) Storage::makeDirectory($pathToSave);

					$this->save($object,
						$pathToSave . '/' . $filename,
						$filename,
						file_get_contents("$pathToPhotos/$file"), FileEnum::PHOTOS
					);
				}
			}
		}
	}

	private function save($object, $path, $filename, $file, $fileType = FileEnum::COVER): void
	{
		Storage::disk('local')->put($path, $file);
		$object->files()->updateOrCreate([
			'fileable_type' => get_class($object),
			'fileable_id' => $object->id,
			'filename' => $filename,
			'type' => $fileType
		]);
	}

	private function getExtension(string $path): string
	{
		return preg_replace('/.+\./', '', $path);
	}

}
