@extends('layout.template')

@section('content')
	<main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
		<div class="container">
			<div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
				<h1 class="mb-5 text-lg font-semibold">Новый пароль</h1>
				<form class="space-y-3" method="post" action="">
					<x-form.text-input name="password" type="password" required placeholder="Новый пароль"></x-form.text-input>
					<x-form.text-input name="password_confirmation" type="password" required placeholder="Повторите пароль"></x-form.text-input>
					<x-form.form-red-button text="Обновить пароль"></x-form.form-red-button>
				</form>
				<x-form.policy></x-form.policy>
			</div>
		</div>
	</main>
@endsection
