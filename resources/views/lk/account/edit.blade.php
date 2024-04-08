@extends('layout.template')

@section('content')
	<main class="py-16 lg:py-20">
		<div class="container">
			<section>
				<h1 class="mb-8 text-lg lg:text-[42px] font-black text-center">Редактировать профиль</h1>
				<div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
					<form class="space-y-3" enctype="multipart/form-data" method="post" action="{{ route('user.lk.update') }}">
						@csrf
						<x-form.text-input
							name="name"
							type="text"
							required
							placeholder="Имя"
							value="{{ $user->name }}"
							label="xxx"
						></x-form.text-input>

						<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
							<div>
								<x-form.text-input name="password" type="password" placeholder="Пароль"></x-form.text-input>
							</div>
							<div>
								<x-form.text-input label="xxx" name="password_confirmation" type="password" placeholder="Подтвердите пароль"></x-form.text-input>
							</div>
						</div>

						<div class="edit_avatar flex justify-between">
							<div class="edit_avatar_image">
								<img src="{{ $user->getCover() ?? noImage() }}" alt="{{ $user->name }}">
							</div>
							<div class="edit_avatar_form">
								<p class="text-white">Загрузить аватар</p>
								<x-form.file-input name="cover"></x-form.file-input>
							</div>
						</div>

						<x-form.error-messages></x-form.error-messages>

						@if(session()->has('success'))
							<x-form.success-messages text="{{ session()->get('success') }}"></x-form.success-messages>
						@endif

						<p class="text-white">Телефон, к которому привязан Ваш аккаунт</p>
						<x-form.disabled-text-input type="tel" value="{{ $user->phone }}"></x-form.disabled-text-input>
						<p class="text-white">E-mail, к которому привязан Ваш аккаунт</p>
						<x-form.disabled-text-input type="email" value="{{ $user->email }}"></x-form.disabled-text-input>
						<x-form.form-success-button text="Обновить данные"></x-form.form-success-button>

					</form>
					<form action="{{ route('user.lk.destroy') }}" method="post" class="delete_account_form">
						@csrf
						<x-form.form-red-button text="Удалить аккаунт"></x-form.form-red-button>
					</form>
				</div>

			</section>
		</div>
	</main>
@endsection
