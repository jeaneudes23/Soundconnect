@php
    $classes = $following ?? false ? 'border-primary relative rounded border-2 px-4 py-2 text-sm font-semibold capitalize tracking-widest' : 'border-primary relative rounded border-2 px-4 py-2 text-sm font-semibold capitalize tracking-widest bg-primary text-white';
    $text = ($following ?? false) ? 'Unfollow' : 'Follow';
@endphp
<button {{$attributes->merge(['class'=>$classes])}}>
    <span wire:loading.class="opacity-0">{{$text}}</span>
    <div wire:loading class="absolute inset-0 m-auto h-3/5 aspect-square animate-spin border-t-primary border-4 rounded-full">
            
    </div>
</button>