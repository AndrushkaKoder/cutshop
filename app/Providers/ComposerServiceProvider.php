<?php

namespace App\Providers;

use App\Http\Composer\Frontend\Header;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
//		View::composer('layout.header', Header::class);
	}
}
