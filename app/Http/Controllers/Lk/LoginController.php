<?php

namespace App\Http\Controllers\Lk;

use App\Helpers\ValidateHelperTrait;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	use ValidateHelperTrait;

	public function index()
	{
		return view('lk.login.index');
	}

	public function login(Request $request): RedirectResponse
	{
		if(!$request->validate([
			'phone' => ['required', "min:{$this->minLengthPhoneNumber}"],
			'password' => ['required']
		])) {
			return redirect()->back()->withErrors([
				'phone' => 'Проверьте правильность введенных данных'
			]);
		}

		$phoneNumber = $this->correctPhoneNumber($request->input('phone'));

		if (!User::query()->where('phone', $phoneNumber)->count()) {
			return redirect()->back()->withErrors([
				'phone' => 'Пользователя с таким номером телефона не обнаружено =('
			]);
		}

		if (Auth::attempt([
			'phone' => $phoneNumber,
			'password' => $request->input('password')
		])) {
			$request->session()->regenerate();
			return redirect()->route('user.lk.edit');
		}

		return redirect()->back()->withErrors([
			'phone' => 'Неверный логин / пароль'
		]);
	}


	public function logout(Request $request): RedirectResponse
	{
		if (Auth::check()) {
			Auth::logout();
			$request->session()->regenerateToken();
			$request->session()->invalidate();
			return redirect()->route('home');
		}

		return redirect()->back();
	}
}
