@extends('layout.template')

@section('content')
	<main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
		<div class="container">
			<div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
				<h1 class="mb-5 text-lg font-semibold">Восстановить пароль</h1>
				<form class="space-y-3" method="post" action="{{ route('user.password_reset') }}">
					@csrf
					<x-form.text-input
						name="email"
						value="{{ old('email') }}"
						type="email"
						required
						placeholder="E-mail для восстановления"
					></x-form.text-input>
					<x-form.form-red-button text="Сбросить пароль"></x-form.form-red-button>
				</form>
				<div class="space-y-3 mt-5">
					<div class="text-xxs md:text-xs text-center">
						<a href="{{ route('user.login.index') }}" class="text-white hover:text-white/70 font-bold">
							Вернуться к аутентификации
						</a>
					</div>
				</div>

				<x-form.error-messages></x-form.error-messages>

				@if(session()->has('success'))
					<x-form.success-messages text="{{ session()->get('success') }}"></x-form.success-messages>
				@endif

				<x-form.policy></x-form.policy>
			</div>
		</div>
	</main>
@endsection
