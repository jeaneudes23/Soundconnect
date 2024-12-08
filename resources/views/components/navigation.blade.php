<nav class="hidden md:block sticky top-0 z-10 bg-white text-gray-600 shadow">
    <div class="container mx-auto flex items-center justify-between py-2">
      <div class="flex items-center gap-4">
        <a href="{{route('home')}}">
          <x-application-logo class="h-12 w-12"></x-application-logo>
        </a>
        <div class="group">
          <button class="inline-flex items-center rounded-lg border px-4 py-2">
            Communities
            <span
              ><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier"><path class="stroke-current" d="M7 10L12 15L17 10" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g></svg
            ></span>
          </button>
          <div class="text-sm relative">
            <ul class="absolute left-0 top-2 max-h-32 w-52 scale-0 divide-y overflow-auto bg-white shadow transition-all group-focus-within:scale-100">
              <li class="hover:bg-gray-100"><a class="block px-4 py-2 transition-all hover:text-gray-700" href="{{route('home')}}">Home</a></li>
              @forelse (Auth::user()->communities as $community)
              <li class="hover:bg-gray-100"><a class="block px-4 py-2 transition-all hover:text-gray-700" href="{{route('community.show', ['handle_name' => $community->handle_name ])}}">{{ __('c/') }}{{ $community->name }}</a></li>
              @empty
              <li class="hover:bg-gray-100"><a class="block px-4 py-2 transition-all hover:text-gray-700" href="{{route('explore.communities')}}">Join more Communities</a></li>
              @endforelse
            </ul>
          </div>
        </div>   
      </div>

        <ul class="flex items-center justify-between gap-2">
          <li><a class="hover:text-primary px-4 py-2 transition-all inline-flex gap-1 items-center" href="{{route('explore')}}"><x-heroicon-o-search class="w-5 h-5" /> Explore</a></li>
          @if (auth()->user()->unreadNotifications()->where('action','message')->count()>0)
            <li><a class="hover:text-primary text-red-600 block px-4 py-2 transition-all" href="{{route('messages.index')}}"><x-heroicon-o-search class="w-5 h-5" /> Messages <span class="font-seminold">({{auth()->user()->unreadNotifications()->where('action','message')->count()}})</span></a></li>
          @else
            <li><a class="hover:text-primary block px-4 py-2 transition-all" href="{{route('messages.index')}}">Messages</a></li>
          @endif
          @if (auth()->user()->unreadNotifications()->where('action','!=','message')->count()>0)
            <li><a class="hover:text-primary text-red-600 block px-4 py-2 transition-all" href="{{route('notifications')}}">Notifications <span class="font-semibold">({{auth()->user()->unreadNotifications()->where('action','!=','message')->count()}})</span></a></li>
          @else
            <li><a class="hover:text-primary block px-4 py-2 transition-all" href="{{route('notifications')}}">Notifications</a></li>
          @endif
          <li><a class="hover:text-primary block px-4 py-2 transition-all" href="{{route('post.create')}}">Create Post</a></li>
          <li class="group">
            <button class="inline-flex items-center rounded-lg border px-4 py-2">
              {{auth()->user()->username}}
              <span
                ><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier"><path class="stroke-current" d="M7 10L12 15L17 10" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g></svg
              ></span>
            </button>
            <div class="relative">
              <ul class="absolute right-0 top-2 z-30 w-32 scale-0 divide-y bg-white text-black shadow-sm transition-all group-focus-within:scale-100">
                <li class="hover:bg-gray-100"><a class="block px-4 py-2 transition-all hover:text-gray-700" href="{{route('profile.show',['username' => auth()->user()->username])}}" href="">Profile</a></li>
                <li class="hover:bg-gray-100">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="block px-4 py-2 transition-all hover:text-gray-700" type="submit">Logout</button>
                  </form>
                </li>
              </ul>
            </div>
          </li>
        </ul>
    </div>
  </nav>
  
<nav x-data="{ open: false }" class="md:hidden sticky top-0 z-10 bg-white text-gray-600 shadow">
    <div class="container mx-auto flex flex-col justify-between py-2">
      <div class="flex items-center gap-4">
        <a href="{{route('home')}}">
          <x-application-logo class="h-12 w-12"></x-application-logo>
        </a>
        <div class="group">
          <button class="inline-flex items-center rounded-lg border px-4 py-2">
            Home
            <span
              ><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier"><path class="stroke-current" d="M7 10L12 15L17 10" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g></svg
            ></span>
          </button>
          <div class="relative">
            <ul class="absolute left-0 top-2 max-h-32 w-52 scale-0 divide-y overflow-auto bg-white shadow transition-all group-focus-within:scale-100">
              <li class="hover:bg-gray-100"><a class="block px-4 py-2 transition-all hover:text-gray-700" href="{{route('home')}}">Home</a></li>
              @forelse (Auth::user()->communities as $community)
              <li class="hover:bg-gray-100"><a class="block px-4 py-2 transition-all hover:text-gray-700" href="{{route('community.show', ['handle_name' => $community->handle_name ])}}">{{ __('c/') }}{{ $community->name }}</a></li>
              @empty
              <li class="hover:bg-gray-100"><a class="block px-4 py-2 transition-all hover:text-gray-700" href="{{route('explore.communities')}}">Join more Communities</a></li>
              @endforelse
            </ul>
          </div>
        </div>
        <button class="ml-auto rounded-lg border p-2 md:hidden" @click="open = !open">
          <svg class="w-5 h-5" viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 12.32H22" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M2 18.32H22" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M2 6.32001H22" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </button>     
      </div>

        <ul x-show="open" class="pt-4 divide-y flex flex-col">
          <li><a class="border-t hover:text-primary block px-4 py-2 transition-all" href="{{route('explore')}}"><x-heroicon-o-search class="size-5"/> Explore</a></li>
          @if (auth()->user()->unreadNotifications()->where('action','message')->count()>0)
            <li><a class="hover:text-primary text-red-600 block px-4 py-2 transition-all" href="{{route('messages.index')}}">Messages <span class="font-seminold">({{auth()->user()->unreadNotifications()->where('action','message')->count()}})</span></a></li>
          @else
            <li><a class="hover:text-primary block px-4 py-2 transition-all" href="{{route('messages.index')}}">Messages</a></li>
          @endif
          @if (auth()->user()->unreadNotifications()->where('action','!=','message')->count()>0)
            <li><a class="hover:text-primary text-red-600 block px-4 py-2 transition-all" href="{{route('notifications')}}">Notifications <span class="font-semibold">({{auth()->user()->unreadNotifications()->where('action','!=','message')->count()>0}})</span></a></li>
          @else
            <li><a class="hover:text-primary block px-4 py-2 transition-all" href="{{route('notifications')}}">Notifications</a></li>
          @endif
          <li><a class="hover:text-primary block px-4 py-2 transition-all" href="{{route('post.create')}}">Create Post</a></li>
          <li class="group px-4 py-2 ">
            <button class="inline-flex items-center rounded-lg border px-4 py-2">
              {{auth()->user()->username}}
              <span
                ><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier"><path class="stroke-current" d="M7 10L12 15L17 10" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g></svg
              ></span>
            </button>
            <div class="relative">
              <ul class="absolute top-2 z-30 w-32 scale-0 divide-y bg-white text-black shadow-sm transition-all group-focus-within:scale-100">
                <li class="hover:bg-gray-100"><a class="block px-4 py-2 transition-all hover:text-gray-700" href="{{route('profile.show',['username' => auth()->user()->username])}}" href="">Profile</a></li>
                <li class="hover:bg-gray-100">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="block px-4 py-2 transition-all hover:text-gray-700" type="submit">Logout</button>
                  </form>
                </li>
              </ul>
            </div>
          </li>
        </ul>

    </div>
  </nav>
  