<?php

namespace App\Models\File;

use App\Models\File;
use Illuminate\Support\Facades\File as FacadeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
	/*
	 * Трейт полиморфного отношения с моделью, в которой он будет импортирован.
	 * У модели становятся доступны методы получения файлов типа Основное фото (cover) и доп. фото (photos).
	 *
	 * В дальнейшнем будет реализовано сохранение видео и файлов любого формата чтения
	 */

	public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
	{
		return $this->morphMany(File::class, 'fileable');
	}

	public function getCover(): ?string
	{
		$filename = $this->files()
			->where('type', FileEnum::COVER)
			->firstOrFail()
			->filename;

		$filepath = $this->getObjectFilePath($filename);
		return Storage::exists('public' . "/$filepath") ? "/storage/{$filepath}" : null;
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
			$filePath = $this->getObjectFilePath($photo, 'photos');
			if (Storage::exists('public' . "/{$filePath}")) {
				$photosArray[] = "/storage/{$filePath}";
			}
		}
		return $photosArray;
	}

	public function getFiles()
	{

	}

	private function getObjectFilePath(string $endPoint, string $type = 'cover'): string
	{
		return get_class($this) . '/' . $this->id . "/{$type}/{$endPoint}";
	}

	public function saveCover(Request $request): void
	{
		$uploadFile = $request->file('file');

		if ($uploadFile) {
			$pathToSave = 'public/' . get_class($this) . '/' . $this->id . '/cover/';
			if (!is_dir($pathToSave)) Storage::makeDirectory($pathToSave);

			$extension = $request->file('file')->extension();
			$filename = md5($uploadFile->getFilename()) . ".{$extension}";
//			dd($pathToSave . '/' . $filename);
			FacadeFile::move($pathToSave . $filename, $uploadFile);

			$this->files()->where('type', FileEnum::COVER)->updateOrCreate([
				'fileable_type' => get_class($this),
				'fileable_id' => $this->id,
				'filename' => $filename,
				'type' => FileEnum::COVER
			]);
		}
	}

}
