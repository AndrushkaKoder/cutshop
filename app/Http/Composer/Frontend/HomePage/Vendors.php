<?php

namespace App\Http\Composer\Frontend\HomePage;

use App\Models\Vendor;
use Illuminate\View\View;

class Vendors
{
	public function compose(View $view): void
	{
		$view->with('vendors', $this->getVendors());
	}

	private function getVendors()
	{
		return Vendor::query()
			->where('visible', 1)
			->where('in_main', 1)
			->with('files')
			->get();
	}

}
