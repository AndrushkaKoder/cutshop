<?php

namespace App\Models\File;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait FileTrait
{

	public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
	{
		return $this->morphMany(File::class, 'fileable');
	}

	public function getCover(): ?string
	{
		$file = $this->files()
			->where('type', FileEnum::COVER)
			->first();

		if (!$file) return null;

		$filepath = $this->getObjectFilePath($file->filename);
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

	public function saveCover(Request $request): void
	{
		$path = $request->file('cover')->store('xxx', 'public');
		dd($path);
	}

	private function getObjectFilePath(string $endPoint, string $type = 'cover'): string
	{
		return get_class($this) . '/' . $this->id . "/{$type}/{$endPoint}";
	}

}
