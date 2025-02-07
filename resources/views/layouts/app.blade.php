<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />

  <meta name="application-name" content="{{ config('app.name') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>{{ config('app.name') . ' | ' . $title }}</title>

  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles

  @stack('scripts')
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body class="overflow-x-hidden text-gray-600 antialiased">
  <x-auth-session-status class="mb-4" :status="session('status')" />
  <x-message-status class="mb-4" :message="session('message')" />

  <x-navigation />
  {{ $slot }}

  <footer class="mt-12">  
    <div class="bg-gray-100 px-2 py-2 text-center text-sm">Copyright @Christian 2024</div>
  </footer>
  @livewire('notifications')
  <script async type="text/javascript" src="{{ asset('storage/js/player.js') }}"></script>
  <script>
    if (document.querySelector('#message')) {
      document.querySelector('#message').classList.remove('-translate-y-full')
      setTimeout(() => {
        document.querySelector('#message').classList.add('-translate-y-full')
      }, 3000);
    }
  </script>
  @livewireScripts
</body>

</html>
