<?php

namespace App\Helpers;

use App\Http\Requests\RegisterStoreRequest;
use App\Models\User;

trait ValidateHelperTrait
{

	public function correctPhoneNumber(string $phone): string
	{
		return preg_replace('/\W+/', '', $phone);
	}

	public function validatePhone(string $number): bool
	{
		return (strlen($number) === 11) && (intval($number[1]) === 9);
	}

	public function redirectTo(string $path = '/', int $code = 302): \Illuminate\Http\RedirectResponse
	{
		return redirect()->to($path, $code);
	}

	public function checkExistsUser(RegisterStoreRequest $request): bool
	{
		$phone = $this->correctPhoneNumber($request->input('phone'));
		return boolval(User::query()
			->where('email', $request->input('email'))
			->orWhere('phone', $phone)
			->count());
	}

	public function checkPhoneNumber(RegisterStoreRequest $request): bool
	{
		return $this->validatePhone($this->correctPhoneNumber($request->input('phone')));
	}

}
