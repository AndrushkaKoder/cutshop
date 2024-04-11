<?php

namespace App\Providers;

use App\Http\Composer\Frontend\HomePage\Vendors;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{

	public function register(): void
	{
	}

	public function boot(): void
	{
		View::composer('home.sections.vendors', Vendors::class);
	}
}
