<x-slot name="title">Explore</x-slot>
<div class="mb-20">
  <x-split-screen>
    <x-split-screen-left>
      <div class="group border-b-8 shadow">
        <button
                class="flex w-full items-center justify-between gap-2 bg-primary px-4 py-2 font-semibold tracking-wide text-white first-letter:text-xl">
          <div class="inline-flex items-end gap-2">
            <span>
              <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                        stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="#fff"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
              </svg>
            </span>
            Top Users
          </div>
          <span>
            <svg class="w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M4.29289 8.29289C4.68342 7.90237 5.31658 7.90237 5.70711 8.29289L12 14.5858L18.2929 8.29289C18.6834 7.90237 19.3166 7.90237 19.7071 8.29289C20.0976 8.68342 20.0976 9.31658 19.7071 9.70711L12.7071 16.7071C12.3166 17.0976 11.6834 17.0976 11.2929 16.7071L4.29289 9.70711C3.90237 9.31658 3.90237 8.68342 4.29289 8.29289Z"
                      fill="#ffffff"></path>
              </g>
            </svg>
          </span>
        </button>
        <div class="max-h-0 overflow-auto px-4 transition-all group-focus-within:max-h-52">
          <a href="{{ route('explore.users') }}" class="mt-4 inline-block py-2 text-primary hover:underline">View and
            search for more users.</a>
          @forelse ($users as $user)
            <div class="my-4 rounded bg-gray-100 px-4 py-2 text-sm text-gray-600">
              <div class="mb-1">
                <a class="font-semibold hover:underline" href="/profile/{{ $user->username }}">{{ $user->name }} <span
                        class="font-normal">{{ '@' . $user->username }}</span></a>
              </div>
              <div class="space-x-2">
                <span><span class="font-semibold">{{ $user->posts->count() }}</span> Posts</span>
                <span><span class="font-semibold">{{ $user->profile->followers->count() }}</span> Followers</span>
                <span><span class="font-semibold">{{ $user->following->count() }}</span> Following</span>
              </div>

            </div>
          @empty
            <span>No Users</span>
          @endforelse
        </div>
      </div>

      <div class="group border-b-8 shadow">
        <button
                class="flex w-full items-center justify-between gap-2 bg-primary px-4 py-2 font-semibold tracking-wide text-white first-letter:text-xl">
          <div class="inline-flex items-end gap-2">
            <span>
              <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path d="M13.75 2C13.75 1.58579 13.4142 1.25 13 1.25C12.5858 1.25 12.25 1.58579 12.25 2V14.5359C11.4003 13.7384 10.2572 13.25 9 13.25C6.37665 13.25 4.25 15.3766 4.25 18C4.25 20.6234 6.37665 22.75 9 22.75C11.6234 22.75 13.75 20.6234 13.75 18V6.243C14.9875 7.77225 16.8795 8.75 19 8.75C19.4142 8.75 19.75 8.41421 19.75 8C19.75 7.58579 19.4142 7.25 19 7.25C16.1005 7.25 13.75 4.8995 13.75 2Z"
                        fill="#fff"></path>
                </g>
              </svg>
            </span>
            Posts
          </div>
          <span>
            <svg class="w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M4.29289 8.29289C4.68342 7.90237 5.31658 7.90237 5.70711 8.29289L12 14.5858L18.2929 8.29289C18.6834 7.90237 19.3166 7.90237 19.7071 8.29289C20.0976 8.68342 20.0976 9.31658 19.7071 9.70711L12.7071 16.7071C12.3166 17.0976 11.6834 17.0976 11.2929 16.7071L4.29289 9.70711C3.90237 9.31658 3.90237 8.68342 4.29289 8.29289Z"
                      fill="#ffffff"></path>
              </g>
            </svg>
          </span>
        </button>
        <div class="max-h-0 overflow-auto px-4 transition-all group-focus-within:max-h-80">
          <a href="{{ route('explore.posts') }}" class="mt-4 inline-block py-2 text-primary hover:underline">View and
            search for more posts.</a>
          <div class="space-y-6">
            @forelse ($posts as $post)
              <x-post-card :post="$post" wire:key="{{ $post->id }}" />
            @empty
              <div>Follow People and Join Communities To see more posts</div>
            @endforelse
          </div>
        </div>
      </div>

      <div class="group border-b-8 shadow">
        <button
                class="flex w-full items-center justify-between gap-2 bg-primary px-4 py-2 font-semibold tracking-wide text-white first-letter:text-xl">
          <div class="inline-flex items-end gap-2">
            <span>
              <svg class="h-8 w-8" fill="#ffffff" viewBox="-3 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"
                   stroke="#ffffff">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <title>group</title>
                  <path
                        d="M20.906 20.75c1.313 0.719 2.063 2 1.969 3.281-0.063 0.781-0.094 0.813-1.094 0.938-0.625 0.094-4.563 0.125-8.625 0.125-4.594 0-9.406-0.094-9.75-0.188-1.375-0.344-0.625-2.844 1.188-4.031 1.406-0.906 4.281-2.281 5.063-2.438 1.063-0.219 1.188-0.875 0-3-0.281-0.469-0.594-1.906-0.625-3.406-0.031-2.438 0.438-4.094 2.563-4.906 0.438-0.156 0.875-0.219 1.281-0.219 1.406 0 2.719 0.781 3.25 1.938 0.781 1.531 0.469 5.625-0.344 7.094-0.938 1.656-0.844 2.188 0.188 2.469 0.688 0.188 2.813 1.188 4.938 2.344zM3.906 19.813c-0.5 0.344-0.969 0.781-1.344 1.219-1.188 0-2.094-0.031-2.188-0.063-0.781-0.188-0.344-1.625 0.688-2.25 0.781-0.5 2.375-1.281 2.813-1.375 0.563-0.125 0.688-0.469 0-1.656-0.156-0.25-0.344-1.063-0.344-1.906-0.031-1.375 0.25-2.313 1.438-2.719 1-0.375 2.125 0.094 2.531 0.938 0.406 0.875 0.188 3.125-0.25 3.938-0.5 0.969-0.406 1.219 0.156 1.375 0.125 0.031 0.375 0.156 0.719 0.313-1.375 0.563-3.25 1.594-4.219 2.188zM24.469 18.625c0.75 0.406 1.156 1.094 1.094 1.813-0.031 0.438-0.031 0.469-0.594 0.531-0.156 0.031-0.875 0.063-1.813 0.063-0.406-0.531-0.969-1.031-1.656-1.375-1.281-0.75-2.844-1.563-4-2.063 0.313-0.125 0.594-0.219 0.719-0.25 0.594-0.125 0.688-0.469 0-1.656-0.125-0.25-0.344-1.063-0.344-1.906-0.031-1.375 0.219-2.313 1.406-2.719 1.031-0.375 2.156 0.094 2.531 0.938 0.406 0.875 0.25 3.125-0.188 3.938-0.5 0.969-0.438 1.219 0.094 1.375 0.375 0.125 1.563 0.688 2.75 1.313z">
                  </path>
                </g>
              </svg>
            </span>
            Communities
          </div>
          <span>
            <svg class="w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M4.29289 8.29289C4.68342 7.90237 5.31658 7.90237 5.70711 8.29289L12 14.5858L18.2929 8.29289C18.6834 7.90237 19.3166 7.90237 19.7071 8.29289C20.0976 8.68342 20.0976 9.31658 19.7071 9.70711L12.7071 16.7071C12.3166 17.0976 11.6834 17.0976 11.2929 16.7071L4.29289 9.70711C3.90237 9.31658 3.90237 8.68342 4.29289 8.29289Z"
                      fill="#ffffff"></path>
              </g>
            </svg>
          </span>
        </button>
        <div class="max-h-0 overflow-auto px-4 transition-all group-focus-within:max-h-52">
          <a href="{{ route('explore.communities') }}"
             class="mt-4 inline-block py-2 text-primary hover:underline">View and search for more communities.</a>
          @forelse ($communities as $community)
            <div class="my-4 rounded bg-gray-100 px-4 py-2 text-sm text-gray-600">
              <div class="my-1">
                <a class="font-semibold hover:underline"
                   href="{{ route('community.show', ['handle_name' => $community->handle_name]) }}">{{ $community->name }}<span
                        class="font-normal">{{ '@' . $community->handle_name }}</span></a>
              </div>
              <div class="space-x-2">
                <span><span class="font-semibold">{{ $community->posts->count() }}</span> Posts</span>
                <span><span class="font-semibold">{{ $community->members->count() }}</span> Members</span>
              </div>
              <div>
                <span>#hiphop</span>
                <span>#dance</span>
              </div>
            </div>
          @empty
          @endforelse

        </div>
      </div>
    </x-split-screen-left>
    <x-split-screen-right>
    </x-split-screen-right>
  </x-split-screen>
</div>
