@props(['joined'])
@php
    $classes = $joined ?? false ? 'border-primary relative rounded border-2 px-4 py-2 text-sm font-semibold capitalize tracking-widest' : 'border-primary relative rounded border-2 px-4 py-2 text-sm font-semibold capitalize tracking-widest bg-primary text-white';
    $text = $joined ?? false ? 'Leave' : 'Join';
@endphp
<button {{ $attributes->merge(['class' => $classes]) }}>
    <span wire:loading.class="opacity-0">{{ $text }}</span>
    <div wire:loading class="border-t-primary absolute inset-0 m-auto aspect-square h-3/5 animate-spin rounded-full border-4"></div>
</button>
