<?php

namespace Database\Seeders;


use App\Models\Param;

class ParamsSeeder extends BaseSeeder
{
	public function run(): void
	{
		$seedFile = $this->getSeedFile(new Param());
		foreach ($seedFile as $i => $data) {
			Param::query()->create($seedFile);
		}

	}

}
