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
  <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased text-foreground">
  <div class="grid">
    <div class="stack">
      <img src="{{asset('aa.jpg')}}" class="w-full h-screen object-cover" alt="">
    </div>
    <div class="stack grid bg-black/80 bg-gradient-to-tl from-primary/20 to-30% to-black/10">
      <div class="container pt-20 grid content-center">
        <div class="max-w-screen-md grid gap-4">
          <h1 class="text-6xl font-bold capitalize">A Community of talented musicians</h1>
          <p class="text-lg text-foreground/80">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis sit veniam quas harum voluptatem expedita, voluptatibus velit voluptas recusandae mollitia.</p>
          <div class="flex items-center gap-4">
            <a class="bg-primary text-primary-foreground border-2 font-medium tracking-wide py-2 text-lg rounded-full px-8" href="{{route('register')}}">Register</a>
            <a class="bg-primary-foreground/20 border-2 font-medium tracking-wide py-2 text-lg rounded-full px-8" href="{{route('login')}}">Login</a>
          </div>
        </div>
      </div>
    </div>
    <nav class="stack self-start">
      <div class="h-20 container flex items-center justify-between">
        <a href="{{route('home')}}"><x-application-logo /></a>
        <a class="bg-primary text-primary-foreground font-medium tracking-wide py-3 text-lg rounded-full px-8" href="{{route('register')}}">Register</a>
      </div>
    </nav>
  </div>
</body>

</html>
