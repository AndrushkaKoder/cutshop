<?php

namespace App\Http\Controllers\Lk\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
	public function index()
	{
		return view('lk.password.forget_password');
	}

	public function reset($token)
	{
		return view('lk.password.reset_password', ['token' => $token]);
	}

	public function update(UpdatePasswordRequest $request)
	{
		$status = Password::reset([
			'email' => $request->validated('email'),
			'password' => $request->validated('password'),
			'password_confirmation' => $request->input('password_confirmation'),
			'token' => $request->validated('token')
		], function ($user, $password) {
			/**
			 * @var User $user
			 */
			$user->update([
				'password' => $password
			]);
			event(new PasswordReset($user));
		});

		if ($status === Password::PASSWORD_RESET) {
			session()->flash('success', 'Пароль успешно изменен!');
			return redirect()->to('/login');
		}

		return redirect()->back()->withErrors([
			'password' => 'Проверьте правильность введенных данных!'
		]);
	}
}
