<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{

	protected $signature = 'user:create';
	protected $description = 'Создание дефолтного юзера';

	public function handle(): void
	{
		if (!app()->isProduction()) {
			if (!User::query()->count()) {
				User::query()->create([
					'name' => 'Андрей',
					'email' => 'Andrusha.kolmakov@gmail.com',
					'phone' => '79623734441',
					'password' => Hash::make('12345'),
				]);
				$this->info('The user has been successfully created');
			} else {
				$this->error('Users already exists!');
			}
		}
	}
}
