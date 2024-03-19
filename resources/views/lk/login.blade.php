@extends('layout.template')

@section('content')
	<main class="md:min-h-screen md:flex md:items-center md:justify-center">
		<div class="container">

			<div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
				<h1 class="mb-5 text-lg font-semibold">Вход в аккаунт</h1>

				<form class="space-y-3" method="post" action="{{ route('post.login') }}">
					<x-form.text-input :isError="true" type="email" required placeholder="Ваш E-mail" name="email"></x-form.text-input>
					<x-form.text-input type="password" required placeholder="Ваш пароль" name="password"></x-form.text-input>
					<x-form.form-red-button></x-form.form-red-button>
				</form>

				<div class="space-y-3 mt-5">
					<div class="text-xxs md:text-xs"><a href="lost-password.html" class="text-white hover:text-white/70 font-bold">Забыли пароль?</a></div>
					<div class="text-xxs md:text-xs"><a href="register.html" class="text-white hover:text-white/70 font-bold">Регистрация</a></div>
				</div>
				<ul class="flex flex-col md:flex-row justify-between gap-3 md:gap-4 mt-14 md:mt-20">
					<li>
						<a href="#" class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium" target="_blank" rel="noopener">Пользовательское соглашение</a>
					</li>
					<li class="hidden md:block">
						<div class="h-full w-[2px] bg-white/20"></div>
					</li>
					<li>
						<a href="#" class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium" target="_blank" rel="noopener">Политика конфиденциальности</a>
					</li>
				</ul>
			</div>

		</div>
	</main>
@endsection
