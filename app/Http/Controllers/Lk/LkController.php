<?php

namespace App\Http\Controllers\Lk;

use App\Helpers\ValidateHelperTrait;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class LkController extends Controller
{
	use ValidateHelperTrait;

	public function edit(Request $request, int $id)
	{
		$user = User::query()->find($id);
		return view('lk.account.edit', ['user' => $user]);
	}

	public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
	{
		if (!$request->validate([
			'name' => ['required', 'min:3'],
			'phone' => ['required', "min:{$this->minLengthPhoneNumber}"],
			'email' => ['required', 'email'],
		])) {
			return redirect()->back()->withErrors([
				'error' => 'Обязательные поля не заполнены!'
			]);
		}
		if ($request->input('password')) {
			if ($request->input('password') !== $request->input('password_confirmation')) {
				return redirect()->back()->withErrors([
					'password' => 'Введенные пароли не совпадают'
				]);
			}
		}

		$user = User::query()->find($id);
		$user->update([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'phone' => $this->correctPhoneNumber($request->input('phone')),
			'password' => $request->input('password')
		]);

		if ($request->file('file'))
			$user->saveCover($request);

		session()->flash('success', 'Данные обновлены!');
		return redirect()->back();
	}
}
