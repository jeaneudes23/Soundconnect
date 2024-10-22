<x-slot name="title">Explore Users</x-slot>
<div>
  <x-split-screen>
    <x-split-screen-left>
      <div>
        <div class="flex gap-4">
          <x-text-input placeholder="Search by name,username, tags" class="w-full placeholder:text-sm" type="text"
                        wire:model.debounce.350ms="search" />
          <x-livewire-primary-button>Search</x-livewire-primary-button>
        </div>
      </div>
      <div>
        @forelse ($users as $user)
          <div class="my-4 rounded bg-gray-100 px-4 py-2 text-sm text-gray-600">
            <div class="mb-1 flex items-center gap-1">
              <div class="relative w-8">
                @if ($user->profile->profileImage())
                  <img class="h-8 w-full rounded-full object-cover" src="{{ asset($user->profile->profileImage()) }}"
                       alt="profile image" />
                @else
                  <div class="flex h-8 w-full items-center justify-center rounded-full bg-primary uppercase text-white">
                    <span class="text-center text-xl">{{ substr($user->name, 0, 2) }}</span>
                  </div>
                @endif
              </div>
              <a class="font-semibold hover:underline" href="/profile/{{ $user->username }}">{{ $user->name }}
                <span class="font-normal">{{ '@' . $user->username }}</span></a>
            </div>
            <div class="space-x-2">
              <span><span class="font-semibold">{{ $user->posts->count() }}</span> Posts</span>
              <span><span class="font-semibold">{{ $user->profile->followers->count() }}</span> Followers</span>
              <span><span class="font-semibold">{{ $user->following->count() }}</span> Following</span>
            </div>
            <ul class="mt-1 flex gap-1">
              @forelse (explode(",", $user->profile->tags) as $tag)
                @if ($tag !== '')
                  <li><span class="rounded font-semibold capitalize">{{ '#' . $tag }}</span></li>
                @endif
              @empty
              @endforelse
            </ul>
          </div>
        @empty
          <span>No Users Found</span>
        @endforelse

      </div>
    </x-split-screen-left>
    <x-split-screen-right>
    </x-split-screen-right>
  </x-split-screen>

</div>
