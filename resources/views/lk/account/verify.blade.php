@extends('layout.template')

@section('content')
	<main class="py-16 lg:py-20">
		<div class="container">
			<section>
				<h1 class="mb-8 text-lg lg:text-[42px] font-black text-center">Подтвердите E-mail</h1>
				<div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
					<p class="my-5 text-white">На email {{ \Illuminate\Support\Facades\Auth::user()->email }} выслано подтверждение</p>
					<form class="space-y-3" method="post" action="{{ route('verification.send') }}">
						@csrf
						<x-form.form-success-button text="Отправить повторно"></x-form.form-success-button>
					</form>
					@if(session()->has('success'))
						<x-form.success-messages text="{{ session('success') }}"></x-form.success-messages>
					@endif
				</div>

			</section>
		</div>
	</main>
@endsection
