<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class Run extends Command
{

	protected $signature = 'app:refresh';
	protected $description = 'Обновление миграций, сидинг данных, сброс кеша приложения';

	public function handle(): void
	{
		$this->call('migrate:fresh');
		$this->call('db:seed');
		$this->call('cache:clear');
//		$this->call('user:create');
	}
}
