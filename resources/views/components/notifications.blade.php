<div class="my-5 p-3">
	<x-form.error-messages></x-form.error-messages>
	@if(session()->has('success'))
		<x-form.success-messages text="{{ session()->get('success') }}"></x-form.success-messages>
	@endif
</div>
