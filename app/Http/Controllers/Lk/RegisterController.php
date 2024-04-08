<?php

namespace App\Http\Controllers\Lk;

use App\Helpers\ValidateHelperTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStoreRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
	use ValidateHelperTrait;

	public function index()
	{
		return view('lk.register.index');
	}

	public function store(RegisterStoreRequest $request): RedirectResponse
	{
		if (!$this->checkPhoneNumber($request)) {
			return redirect()->back()->withErrors([
				'phone' => 'Некорректный номер телефона!'
			]);
		}
		if ($this->checkExistsUser($request)) {
			return redirect()->back()->withErrors([
				'email' => 'Такой пользователь уже зарегистрирован!'
			]);
		}

		$user = User::query()->create([
			'name' => $request->validated('name'),
			'email' => $request->validated('email'),
			'phone' => $this->correctPhoneNumber($request->validated('phone')),
			'password' => $request->validated('password'),
		]);

		Auth::login($user);
		return $this->redirectTo();
	}
}
