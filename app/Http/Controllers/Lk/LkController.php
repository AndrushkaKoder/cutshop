<?php

namespace App\Http\Controllers\Lk;

use App\Helpers\ValidateHelperTrait;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LkController extends Controller
{
	use ValidateHelperTrait;

	public function edit()
	{
		return view('lk.account.edit', ['user' => Auth::user()]);
	}

	public function update(Request $request): \Illuminate\Http\RedirectResponse
	{
		$user = Auth::user();
		$updateData = [];

		/**
		 * @var User $user
		 */

		if (!$request->validate([
			'name' => ['required', 'min:3'],
		])) {
			return redirect()->back()->withErrors([
				'error' => 'Обязательные поля не заполнены!'
			]);
		} else {
			$updateData['name'] = $request->input('name');
		}

		if ($request->input('password') && $request->input('password_confirmation')) {
			if ($request->input('password') !== $request->input('password_confirmation')) {
				return redirect()->back()->withErrors([
					'password' => 'Введенные пароли не совпадают'
				]);
			}
			$updateData['password'] = $request->input('password');
		}

		if ($updateData) $user->update($updateData);
		if ($request->file('cover')) $user->saveCover($request->file('cover'));

		session()->flash('success', 'Данные обновлены!');
		return redirect()->back();
	}

	public function destroy(): \Illuminate\Http\RedirectResponse
	{
		User::query()->whereId(Auth::id())->delete();
		Auth::logout();
		session()->regenerate();
		return $this->redirectTo();
	}
}
