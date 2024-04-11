<?php

namespace App\Http\Controllers\Lk;

use App\Helpers\ValidateHelperTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	use ValidateHelperTrait;

	public function index()
	{
		return view('lk.login.index');
	}

	public function login(LoginRequest $request): RedirectResponse
	{
		$phoneNumber = $this->correctPhoneNumber($request->input('phone'));

		if (!User::query()->where('phone', $phoneNumber)->count()) {
			return redirect()->back()->withErrors([
				'phone' => 'Пользователя с таким номером телефона не обнаружено =('
			]);
		}

		$remember = boolval($request->input('remember_me'));

		if (Auth::attempt([
			'phone' => $phoneNumber,
			'password' => $request->input('password')
		], $remember)) {
			$request->session()->regenerate();
			return $this->redirectTo();
		}

		return redirect()->back()->withErrors([
			'phone' => 'Неверный логин / пароль'
		]);
	}
}
