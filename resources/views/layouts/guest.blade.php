<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="antialiased  text-gray-600">
  <nav class="shadow ">
    <div class="container mx-auto px-2 sm:px-4 md:px-6 lg:px-8 py-2 flex items-center justify-between">
      <a href="{{route('welcome')}}">
        <x-application-logo class="w-12 h-12"></x-application-logo>
      </a>
      <ul class="flex gap-2 font-semibold">
        <li>
          <a class="block px-4 py-2 transition-all hover:text-primary" href="{{ route('welcome') }}">Home</a>
        </li>
        <li>
          <a class="block px-4 py-2 transition-all hover:text-primary" href="{{ route('login')}}">Login</a>
        </li>
        <li>
          <a class="block px-4 py-2 transition-all hover:text-primary" href="{{ route('register')}}">Signup</a>
        </li>
      </ul>
    </div>
  </nav>
    {{ $slot }}
    <div class="sm:hidden">@include('layouts.footer')</div>
  </body>
</html>
