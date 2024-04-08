@extends('layout.template')

@section('content')
	<main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
		<div class="container">
			<div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
				<h1 class="mb-5 text-lg font-semibold text-center">Регистрация</h1>
				<form class="space-y-3" method="post" action="{{ route('user.register.store') }}">
					@csrf
					<x-form.text-input
						name="name"
						type="text"
						value="{{ old('name') }}"
						required
						placeholder="Имя"
					></x-form.text-input>
					<x-form.text-input
						name="email"
						type="email"
						value="{{ old('email') }}"
						required
						placeholder="E-mail"
					></x-form.text-input>
					<x-form.phone-input
						name="phone"
						value="{{ old('phone') }}"
						required
						placeholder="Телефон"
					></x-form.phone-input>

					<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
						<div>
							<x-form.text-input name="password" type="password" required placeholder="Пароль"></x-form.text-input>
						</div>
						<div>
							<x-form.text-input name="password_confirmation" type="password" required placeholder="Подтвердите пароль"></x-form.text-input>
						</div>
					</div>

					<x-form.form-red-button text="Регистрация"></x-form.form-red-button>

					<x-form.error-messages></x-form.error-messages>
				</form>
				<div class="space-y-3 mt-5">
					<div class="text-xxs md:text-xs">
						<p class="text-xs">Есть аккаунт? </p>
						<a href="{{ route('user.login') }}" class="text-white hover:text-white/70 font-bold">Войти</a>
					</div>
				</div>
				<x-form.policy></x-form.policy>
			</div>
		</div>
	</main>
@endsection
