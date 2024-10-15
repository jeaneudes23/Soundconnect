<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />

        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name').' | '. $title }}</title>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Goldman:wght@400;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        
        @stack('scripts')
        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    </head>

    <body class="antialiased text-gray-600 overflow-x-hidden">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-message-status class="mb-4" :message="session('message')" />

        <x-navigation />
        {{ $slot }}
        
        <footer class="p-12">

        </footer>
        @livewire('notifications')
        <script async type="text/javascript" src="{{ asset('storage/js/player.js') }}"></script>
        <script>
            if (document.querySelector('#message'))
            {
                document.querySelector('#message').classList.remove('-translate-y-full')
            setTimeout(() => {
                document.querySelector('#message').classList.add('-translate-y-full')  
            }, 3000);
            }
           
        </script>
        @livewireScripts
    </body>
</html>
