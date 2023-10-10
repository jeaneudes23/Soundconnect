<button id="btn" {{ $attributes->merge(['type' => 'submit', 'class' => 'relative inline-flex items-center px-4 text-sm py-2 bg-primary border border-transparent rounded-md font-semibold text-white capitalize tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    <span wire:loading.class="opacity-0">{{$slot}}</span>
<div wire:loading class="absolute inset-0 m-auto h-3/5 aspect-square animate-spin border-t-primary border-4 rounded-full"></div>
</button>
