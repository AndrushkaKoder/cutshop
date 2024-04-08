<?php

namespace App\Http\Controllers\Lk\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
	public function index()
	{
		return view('lk.password.forget_password');
	}

	public function reset(ResetPasswordRequest $request)
	{
		$user = User::query()->where('email', $request->validated('email'))->first();
		if(!$user) {
			return back()->withErrors([
				'email' => 'Проверьте правильность E-mail!'
			]);
		}

		$status = Password::sendResetLink([
			'email' => $request->validated('email')
		]);

		if($status === Password::RESET_LINK_SENT) {
			session()->flash('success', "Ссылка для сброса пароля была направлена на {$user->email}");
			return redirect()->back();
		}
	}
}
