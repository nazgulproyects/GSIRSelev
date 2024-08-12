@props(['disabled' => false])

<input style="{{ $attributes->get('style') }}; height: 30px;" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>