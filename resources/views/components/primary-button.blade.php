<button {{ $attributes->merge(['type' => 'submit', 'class' => 'relative inline-flex items-center px-4 text-sm py-2 bg-primary border border-transparent rounded-md font-semibold text-white capitalize tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{$slot}}
</button>
