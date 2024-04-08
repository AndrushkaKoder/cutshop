<?php

namespace App\Http\Controllers\Lk;

use App\Helpers\ValidateHelperTrait;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
	use ValidateHelperTrait;

	public function index()
	{
		return view('lk.register.index');
	}

	public function store(Request $request): RedirectResponse
	{
		/**
		 * TODO Создать Форм Реквест классы  для валидации регистрации и аутентификации пользователя
		 */

		if (!$request->validate([
			'email' => ['required', 'email:dns', 'string'],
			'name' => ['required', 'string', 'min:3'],
			'phone' => ['required'],
			'password' => ['required', "min:{$this->minLengthPassword}", 'confirmed'],
		])) {
			return redirect()->back()->withErrors([
				'error' => 'Проверьте правильность введенных данных!'
			]);
		}

		$phoneNumber = $this->correctPhoneNumber($request->input('phone'));

		if (User::query()
			->where('email', $request->input('email'))
			->orWhere('phone', $phoneNumber)
			->count())
			return redirect()->back()->withErrors([
				'email' => 'Пользователь с такими данными уже зарегистрирован!'
			]);

		$user = User::query()->create([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'phone' => $phoneNumber,
			'password' => $request->input('password'),
		]);

		Auth::login($user);

		return $this->redirectTo();
	}
}
