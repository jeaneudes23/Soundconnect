<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />
  <div class="mx-auto max-w-md flex-grow basis-3/4 px-4 my-8  md:px-6 lg:basis-1/2 lg:px-8">
    <h2 class="text-primary my-4 text-center text-xl font-semibold lg:text-2xl">Login</h2>
    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email Address -->
      <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <!-- Password -->
      <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <!-- Remember Me -->
      <div class="mt-4 block">
        <label for="remember_me" class="inline-flex items-center">
          <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember" />
          <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
      </div>

      <div class="mt-4 flex items-center justify-end">
        @if (Route::has('password.request'))
        <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" href="{{ route('password.request') }}"> {{ __('Forgot your password?') }} </a>
        @endif

        <x-primary-button class="ml-3"> {{ __('Log in') }} </x-primary-button>
      </div>
    </form>
  </div>
</x-guest-layout>
