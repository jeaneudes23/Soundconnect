<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">


  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased text-foreground">
  <div class="grid">
    <div class="stack">
      <img src="{{asset('ab.jpg')}}" class="w-full h-screen object-cover" alt="">
    </div>
    <div class="stack grid bg-black/80 bg-gradient-to-tl from-primary/20 to-30% to-black/10">
      <div class="container pt-20 grid content-center">
        <div class="max-w-screen-md grid gap-4">
          <h1 class="text-6xl font-bold capitalize">HOME FOR TALENTED ARTISTS</h1>
          <p class="text-lg text-foreground/80">Welcome to Our Digital Ecosystem for Music Collaboration</p>
          <div class="flex items-center gap-4">
          @if (!auth()->check())
            <a class="bg-primary text-primary-foreground border-2 font-medium tracking-wide py-2 text-lg rounded-full px-8" href="{{route('register')}}">Register</a>
            <a class="bg-primary-foreground/20 border-2 font-medium tracking-wide py-2 text-lg rounded-full px-8" href="{{route('login')}}">Login</a>
            @endif
          </div>
        </div>
      </div>
    </div>
    <nav class="stack self-start">
      <div class="h-20 container flex items-center justify-between">
        <a href="{{route('home')}}"><x-application-logo /></a>
        @if (!auth()->check())
        <a class="bg-primary text-primary-foreground font-medium tracking-wide py-3 text-lg rounded-full px-8" href="{{route('register')}}">Register</a>
        @endif
      </div>
    </nav>
  </div>
</body>

</html>
