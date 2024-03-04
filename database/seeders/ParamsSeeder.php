<?php

namespace Database\Seeders;

use App\Models\Param;
use Illuminate\Database\Seeder;

class ParamsSeeder extends Seeder
{
	public function run(): void
	{
		$seedFile = include_once storage_path('seed/params/params.php');
		if (is_array($seedFile)) $this->seedModel($seedFile);
	}

	protected function seedModel(array $data): void
	{
		Param::query()->delete();
		Param::query()->create($data);
	}
}
