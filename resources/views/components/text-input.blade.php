@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-clraccent focus:ring-clraccent rounded-md shadow-sm']) !!}>
