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
       class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold @if($isError) _is-error @endif"
       name="{{ $name }}"
       @if($placeholder) placeholder="{{ $placeholder }}" @endif
       @if($required) required @endif
       value="{{ $value }}"
      @if($disabled) disabled @endif
>
