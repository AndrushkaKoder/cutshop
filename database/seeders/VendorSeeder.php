<?php

namespace Database\Seeders;

use App\Models\File\SaveFilesTrait;
use App\Models\Vendor;

class VendorSeeder extends BaseSeeder
{

	use SaveFilesTrait;

	public function run(): void
	{
		$seedFile = $this->getSeedFile(new Vendor());
		foreach ($seedFile as $i => $data) {
			$vendor = new Vendor();
			$vendor->fill([
				'title' => $data['title']
			]);
			$vendor->save();
			if (!empty($data['cover'])) $this->saveCover($vendor, $data);
			if (!empty($data['photos'])) $this->savePhotos($vendor, $data);
		}
	}
}
