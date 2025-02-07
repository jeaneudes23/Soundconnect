<x-slot name="title">{{ $community->handle_name }}</x-slot>
<div>
  <x-split-screen>
    <x-split-screen-left>
      <x-community-header :joined="$joined" :community="$community"></x-community-header>
      <div x-data="{ open: false }" id="filters" class="rounded border border-gray-100 p-4 shadow-sm">
        <button x-on:click="open = ! open " class="flex w-full justify-between font-semibold">
          <span>Filter Posts</span>
          <svg class="h-6 w-6 fill-primary" viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M4.29289 8.29289C4.68342 7.90237 5.31658 7.90237 5.70711 8.29289L12 14.5858L18.2929 8.29289C18.6834 7.90237 19.3166 7.90237 19.7071 8.29289C20.0976 8.68342 20.0976 9.31658 19.7071 9.70711L12.7071 16.7071C12.3166 17.0976 11.6834 17.0976 11.2929 16.7071L4.29289 9.70711C3.90237 9.31658 3.90237 8.68342 4.29289 8.29289Z"
                    fill="text-primary"></path>
            </g>
          </svg>
        </button>
        <div x-show="open" class="mt-3 flex flex-wrap text-sm">
          <div class="flex-grow-1 basis-1/2 items-center gap-2">
            <h3 class="font-semibold">Post Type:</h3>
            <select class="w-4/5 rounded-lg border text-xs ring-2 ring-transparent focus:border-0 focus:ring-2 focus:ring-primary"
                    name="" wire:model="postType" id="">
              <option value="">All</option>
              <option value="song">Songs</option>
              <option value="instrumental">Instrumentals</option>
              <option value="text">Text</option>
              <option value="vocal">Vocals/Acapella</option>
            </select>
          </div>
          <div class="flex-grow-1 basis-1/2 items-center gap-2">
            <h3 class="font-semibold">Sort by</h3>
            <select class="w-4/5 rounded-lg border text-xs ring-2 ring-transparent focus:border-0 focus:ring-2 focus:ring-primary"
                    name="" wire:model="sortBy" id="">
              <option value="created_at">New</option>
              <option value="comments_count">Number of Comments</option>
              <option value="liked_by_users_count">Number of likes</option>
            </select>
          </div>
          <div class="flex-grow-1 mt-2 basis-1/2 items-center gap-2">
            <h3 class="font-semibold">Time</h3>
            <select class="w-4/5 rounded-lg border text-xs ring-2 ring-transparent focus:border-0 focus:ring-2 focus:ring-primary"
                    name="" wire:model="timeRange" id="">
              <option value="" selected="">All Time</option>
              <option value="hour">Last hour</option>
              <option value="day">Today</option>
              <option value="week">This Week</option>
              <option value="month">This Month</option>
            </select>
          </div>
          <div class="flex-grow-1 mt-2 basis-1/2 items-center gap-2">
            <h3 class="font-semibold">Order by:</h3>
            <select class="w-4/5 rounded-lg border text-xs ring-2 ring-transparent focus:border-0 focus:ring-2 focus:ring-primary"
                    name="" wire:model="orderBy" id="">
              <option value="asc">Ascending</option>
              <option value="desc">Descending</option>
            </select>
          </div>
        </div>
        <div class="text-lg font-semibold text-primary" wire:loading>Loading</div>
      </div>
      <div class="mt-4 space-y-6">
        @forelse ($posts as $post)
          <x-post-card :post="$post" wire:key="{{ $post->id }}" />
        @empty
          <p class="my-6 px-2 font-semibold sm:px-4">! No Posts In This Community</p>
        @endforelse
      </div>
    </x-split-screen-left>
    <x-split-screen-right :id="$community->id">
      <div class="py-4">
        <div class="relative mx-auto w-16">
          @if ($community->headerImage())
            <img class="block h-16 w-full border-2 border-clraccent object-cover"
                 src="{{ asset($community->headerImage()) }}" alt="profile image" />
          @else
            <div class="flex h-16 w-full items-center justify-center rounded-full bg-primary uppercase text-white">
              <span class="text-center text-xl">{{ substr($community->name, 0, 2) }}</span>
            </div>
          @endif
        </div>
        <div class="mt-4 grid px-2 text-center text-sm">
          <span class="text-base font-semibold">{{ $community->handle_name }}</span>
          <span>{{ 'Created ' . \Carbon\Carbon::parse($community->created_at)->diffForHumans() }}</span>
          <span class="">{{ $community->members->count() }} Members</span>
          <span class="">{{ $community->posts->count() }} Posts</span>
        </div>
      </div>
    </x-split-screen-right>
  </x-split-screen>
</div>
