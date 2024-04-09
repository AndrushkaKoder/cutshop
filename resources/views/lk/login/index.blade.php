@extends('layout.template')

@section('content')
	<main class="md:min-h-screen md:flex md:items-center md:justify-center">
		<div class="container">

			<div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
				<h1 class="mb-5 text-lg font-semibold text-center">Вход в аккаунт</h1>

				<form class="space-y-3" method="post" action="{{ route('user.login') }}">
					@csrf
					<x-form.phone-input
						type="tel"
						required placeholder="phone"
						name="phone"
						value="{{ old('phone') }}"
						placeholder="Номер телефона"
					></x-form.phone-input>
					<x-form.text-input
						type="password"
						required
						placeholder="Ваш пароль"
						name="password"
					></x-form.text-input>
					<x-form.form-red-button text="Войти"></x-form.form-red-button>
				</form>

				@include('components.notifications')

				<div class="space-y-3 mt-5">
					<div class="text-xxs md:text-xs"><a href="{{ route('password.request') }}" class="text-white hover:text-white/70 font-bold">Забыли
							пароль?</a></div>
					<div class="text-xxs md:text-xs"><a href="{{ route('user.register.index') }}" class="text-white hover:text-white/70 font-bold">Регистрация</a>
					</div>
				</div>
				<x-form.policy></x-form.policy>
			</div>

		</div>
	</main>
@endsection
