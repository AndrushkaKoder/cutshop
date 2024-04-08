<?php

namespace App\Http\Composer\Frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Header
{
	public function compose(View $view): View
	{
		return $view->with('user', $this->getUser());
	}

	public function getUser(): ?\Illuminate\Contracts\Auth\Authenticatable
	{
		return Auth::user();
	}

}
