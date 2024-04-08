@props([
	'type' => 'text',
	'isError' => false,
	'placeholder' => '',
	'required' => '',
	'name' => '',
	'id' => '',
	'value' => '',
	'disabled' => ''
])

@if(isset($label))
	<label @if($id) for="{{ $id }}" @endif class="block mb-2 text-sm font-medium text-white-900 dark:text-white">{{ $label }}</label>
@endif
<input type="{{ $type }}"
       @if($id) id="{{ $id }}" @endif
       class="cursor-not-allowed w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-dark/20 outline-none transition text-gray placeholder:text-white text-xxs md:text-xs font-semibold @if($isError) _is-error @endif"
       name="{{ $name }}"
       @if($placeholder) placeholder="{{ $placeholder }}" @endif
       @if($required) required @endif
       value="{{ $value }}"
       disabled
>
