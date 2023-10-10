<x-slot name="title">{{$profile->user->username}}</x-slot>
<div>
  <x-split-screen>
    <x-split-screen-left>
      <div class="mb-4">
        <div class="flex flex-wrap items-start gap-4">
          <div class="relative w-32 md:w-44">
            @if ($profile->profileImage())
            <img class="block h-32 w-full rounded-full object-cover md:h-44" src="{{asset($profile->profileImage())}}" alt="profile image" />
            @else
            <div class="bg-primary flex h-32 w-full items-center justify-center rounded-full uppercase text-white md:h-44">
              <span class="text-center text-xl">{{ substr($profile->user->name, 0, 2) }}</span>
            </div>
            @endif
          </div>
          <div class="text-sm">
            <div>
              <div class="text-xl font-semibold flex gap-2 items-center">{{$profile->user->name}}
                @if ($follows)
                <span class="bg-gray-200 text-gray-500 px-2 rounded-lg text-xs capitalize py-1.5">follows you</span>
                @endif
                </div>
              <div>{{'@'.$profile->user->username}}</div>
              <div>{{'Joined '. \Carbon\Carbon::parse($profile->created_at)->diffForHumans() }}</div>
            </div>
            <div class="flex gap-4 py-2">
              <div><span class="font-semibold">{{$profile->followers->count()}}</span> Followers</div>
              <div><span class="font-semibold">{{$profile->user->following->count()}}</span> Following</div>
              <div><span class="font-semibold">{{$profile->user->posts->count()}}</span> Posts</div>
            </div>
            <div>
              <h3 class="font-semibold">Bio</h3>
              <div class="prose text-sm">{!!$profile->bio!!}</div>
              <ul class="mt-1 flex gap-1">
                @forelse (explode(",", $user->profile->tags) as $tag) @if ($tag !== '')
                <li><span class="rounded font-semibold capitalize">{{ '#'.$tag }}</span></li>
                @endif @empty @endforelse
              </ul>
            </div>
          </div>
        </div>
        <div class="mt-8 space-x-4">
          @can('update', $profile)
          <x-nav-link :href="route('profile.edit')">Edit Profile</x-nav-link>
          <x-nav-link :href="route('profile.settings')">Account Settings</x-nav-link>
          @endcan @cannot('update', $profile)
          <x-nav-link href="{{route('messages.show',['username'=>$profile->user->username])}}">Message</x-nav-link>
          <x-follow-button wire:click="followUnfollow" :following="$following"></x-follow-button>
          @endcannot
        </div>
      </div>
      <hr />
      <div x-data="{open : false}" id="filters" class="mb-4 rounded border border-gray-100 p-4 shadow-sm">
        <button x-on:click="open = ! open " class="flex w-full justify-between font-semibold">
          <span>Filter Posts</span>
          <svg class="fill-primary h-6 w-6" viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier"><path fill-rule="evenodd" clip-rule="evenodd" d="M4.29289 8.29289C4.68342 7.90237 5.31658 7.90237 5.70711 8.29289L12 14.5858L18.2929 8.29289C18.6834 7.90237 19.3166 7.90237 19.7071 8.29289C20.0976 8.68342 20.0976 9.31658 19.7071 9.70711L12.7071 16.7071C12.3166 17.0976 11.6834 17.0976 11.2929 16.7071L4.29289 9.70711C3.90237 9.31658 3.90237 8.68342 4.29289 8.29289Z" fill="text-primary"></path></g>
          </svg>
        </button>
        <div x-show="open" class="mt-3 flex flex-wrap text-sm">
          <div class="flex-grow-1 basis-1/2 items-center gap-2">
            <h3 class="font-semibold">Post Type:</h3>
            <select class="focus:ring-primary w-4/5 rounded-lg border text-xs ring-2 ring-transparent focus:border-0 focus:ring-2" name="" wire:model="postType" id="">
              <option value="">All</option>
              <option value="song">Songs</option>
              <option value="instrumental">Instrumentals</option>
              <option value="text">Text</option>
              <option value="vocal">Vocals/Acapella</option>
            </select>
          </div>
          <div class="flex-grow-1 basis-1/2 items-center gap-2">
            <h3 class="font-semibold">Sort by</h3>
            <select class="focus:ring-primary w-4/5 rounded-lg border text-xs ring-2 ring-transparent focus:border-0 focus:ring-2" name="" wire:model="sortBy" id="">
              <option value="created_at">New</option>
              <option value="comments_count">Number of Comments</option>
              <option value="liked_by_users_count">Number of likes</option>
            </select>
          </div>
          <div class="flex-grow-1 mt-2 basis-1/2 items-center gap-2">
            <h3 class="font-semibold">Time</h3>
            <select class="focus:ring-primary w-4/5 rounded-lg border text-xs ring-2 ring-transparent focus:border-0 focus:ring-2" name="" wire:model="timeRange" id="">
              <option value="" selected="">All Time</option>
              <option value="hour">Last hour</option>
              <option value="day">Today</option>
              <option value="week">This Week</option>
              <option value="month">This Month</option>
            </select>
          </div>
          <div class="flex-grow-1 mt-2 basis-1/2 items-center gap-2">
            <h3 class="font-semibold">Order by:</h3>
            <select class="focus:ring-primary w-4/5 rounded-lg border text-xs ring-2 ring-transparent focus:border-0 focus:ring-2" name="" wire:model="orderBy" id="">
              <option value="asc">Ascending</option>
              <option value="desc">Descending</option>
            </select>
          </div>
        </div>
        <div class="text-primary text-lg font-semibold" wire:loading>Loading</div>
      </div>
      <div class="mb-6 space-y-6">
        @forelse ($posts as $post)
        <livewire:post.show-post :post="$post" :wire:key="$post->id" />
        @empty
        <h2>No Posts Yet</h2>
        @endforelse
      </div>
    </x-split-screen-left>
    <x-split-screen-right>
      <div class="py-4">
        <div class="relative mx-auto w-16">
          @if ($profile->profileImage())
          <img class="block h-16 w-full rounded-full object-cover" src="{{asset($profile->profileImage())}}" alt="profile image" />
          @else
          <div class="bg-primary flex h-16 w-full items-center justify-center rounded-full uppercase text-white">
            <span class="text-center text-xl">{{ substr($profile->user->name, 0, 2) }}</span>
          </div>
          @endif
        </div>
        <div class="mt-4 grid px-2 text-center text-sm">
          <span class="font-semibold">{{$profile->user->name}}</span>
          <span>{{'Joined '. \Carbon\Carbon::parse($profile->created_at)->diffForHumans() }}</span>
          <span>{{$profile->followers->count()}} Followers</span>
          <span>{{$profile->user->following->count()}} Following</span>
          <span>{{$profile->user->posts->count()}} Posts</span>
        </div>
      </div>
    </x-split-screen-right>  
  </x-split-screen>
</div>
