<?php

namespace Database\Seeders;

use App\Models\File\FileTrait;
use App\Models\Vendor;

class VendorSeeder extends BaseSeeder
{

	use FileTrait;

	public function run(): void
	{
		$seedFile = $this->getSeedFile(new Vendor());
		foreach ($seedFile as $i => $data) {
			$vendor = new Vendor();
			$vendor->fill([
				'title' => $data['title']
			]);
			$vendor->save();
			$this->saveFilesIfExists($vendor, $data);
		}
	}
}
