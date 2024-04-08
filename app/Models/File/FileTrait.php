<?php

namespace App\Models\File;

use App\Models\File as ModelFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
	private string $driver = 'public';

	public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
	{
		return $this->morphMany(ModelFile::class, 'fileable');
	}

	public function getCover(): ?string
	{
		$file = $this->files()
			->where('type', FileEnum::COVER)
			->first();

		if (!$file) return null;

		return asset('storage/' . $this->pathToSaveFile($file->filename));
	}

	public function getPhotos(): array
	{
		$photosArray = [];
		$photos = $this->files()
			->where('type', FileEnum::PHOTOS)
			->get()
			->pluck('filename', 'id')
			->toArray();

		foreach ($photos as $photo) {
			$filePath = $this->pathToSaveFile($photo, 'photos');
			if (Storage::exists('public' . "/{$filePath}")) {
				$photosArray[] = "/storage/{$filePath}";
			}
		}
		return $photosArray;
	}

	public function getFiles()
	{

	}

	public function saveCover(mixed $data): void
	{
		if (is_string($data) && str_contains($data, 'http')) {
			$cover = file_get_contents($data);
			$filename = md5($data) . '.' . $this->getExtension($data);
			Storage::disk($this->driver)
				->put(
					$this->pathToSaveFile($filename),
					$cover
				);
		} else {
			$cover = is_object($data)
				?
				$data
				:
				new UploadedFile($this->pathToSeedFile($data), $data);

			$filename = $cover->getClientOriginalName();
			Storage::disk($this->driver)->put($this->pathToSaveFile($filename), $cover->getContent());
		}
		$this->addFileToObject($filename, FileEnum::COVER);
	}

	public function savePhotos(mixed $data): void
	{
		if (is_string($data)) {
			$pathToPhotos = $this->pathToSeedFile($data);
			if (is_dir($pathToPhotos)) {
				$photosArray = scandir($pathToPhotos);
				if (count($photosArray) > 2) {
					foreach ($photosArray as $i => $photo) {
						if ($i === 0 || $i === 1) continue;
						$content = file_get_contents("{$pathToPhotos}/{$photo}");
						$filename = md5($photo) . '.' . $this->getExtension($photo);
						Storage::disk($this->driver)
							->put(
								$this->pathToSaveFile($filename, 'photos'),
								$content
							);
						$this->addFileToObject($filename, FileEnum::PHOTOS);
					}
				}
			}
		}
	}

	public function saveFiles(): void
	{

	}

	private function pathToSaveFile(string $endPoint = '', string $type = 'cover'): string
	{
		return get_class($this) . '/' . $this->id . "/{$type}/{$endPoint}";
	}

	private function getExtension(string $path): string
	{
		return preg_replace('/.+\./', '', $path);
	}

	private function pathToSeedFile(string $file): string
	{
		return storage_path('seed/' . $this->getTable() . '/' . $file);
	}

	private function addFileToObject(string $filename, mixed $type): void
	{
		$params = [
			'fileable_type' => get_class($this),
			'fileable_id' => $this->id,
			'filename' => $filename,
			'type' => $type
		];

		$this->files()->updateOrCreate($type === FileEnum::COVER ? [
			'type' => FileEnum::COVER
		] : [], $params);
	}

}
