@extends('layout.template')

@section('content')
	<main class="py-16 lg:py-20">
		<div class="container">
			<section>
				<h1 class="mb-8 text-lg lg:text-[42px] font-black text-center">Редактировать профиль</h1>
				<div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
					<form class="space-y-3" enctype="multipart/form-data" method="post" action="{{ route('user.lk.update', ['id' => $user->id]) }}">
						@csrf
						<x-form.text-input
							name="name"
							type="text"
							required
							placeholder="Имя"
							value="{{ $user->name }}"
						></x-form.text-input>

						<x-form.text-input
							name="email"
							type="email"
							required
							placeholder="E-mail"
							value="{{ $user->email }}"
						></x-form.text-input>

						<x-form.phone-input
							name="phone"
							placeholder="Телефон"
							required
							value="{{ $user->phone }}"
						></x-form.phone-input>

						<x-form.file-input></x-form.file-input>

						<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
							<div>
								<x-form.text-input name="password" type="password" placeholder="Пароль"></x-form.text-input>
							</div>
							<div>
								<x-form.text-input name="password_confirmation" type="password" placeholder="Подтвердите пароль"></x-form.text-input>
							</div>
						</div>

						<x-form.form-red-button text="Обновить данные"></x-form.form-red-button>
						<x-form.error-messages></x-form.error-messages>
						@if(session()->has('success'))
							<x-form.success-messages text="{{ session()->get('success') }}"></x-form.success-messages>
						@endif

					</form>
				</div>
			</section>
		</div>
	</main>
@endsection
