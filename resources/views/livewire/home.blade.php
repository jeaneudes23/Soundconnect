<div>
  <x-slot name="title">Home</x-slot>
  <x-split-screen>
    <x-split-screen-left>
      <div x-data="{open : false}" id="filters" class="rounded border border-gray-100 p-4 shadow-sm">
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

      <div class="mt-6 space-y-6">
        @forelse ($posts as $post)
        <x-post-card :post="$post" wire:key="{{$post->id}}"/>
        @empty
        <div>
          No Posts Found <br />
          <a class="font-semibold hover:underline" href="{{route('explore')}}">Explore</a> the platform to see more posts
        </div>
        @endforelse
        
      </div>
      @if ($count < $max)
        <div class="my-6">
          <x-livewire-primary-button wire:click='showMore'>Show more</x-livewire-primary-button>
        </div>
      @endif
      
    </x-split-screen-left>
    <x-split-screen-right>
      <div class="py-4 text-center">
        <x-application-logo />
      </div>
    </x-split-screen-right>
  </x-split-screen>
  <script>
    const notice = document.createElement('div')
    notice.innerHTML =`
    <div id="notice" class="bg-gray-100 px-4 py-2 mb-6  text-sm text-gray-500">
          <div class="flex mb-2  justify-between items-center">
            <div class="text-primary mb-1 text-center font-bold">Notice</div>
            <button id="closeNotice">
              <div class="sr-only">Close notice</div>
              <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
            </path>
            </svg>
            </button>
          </div>
          <h3 ></h3>
          <p><span class="font-semibold">Free posts</span> are available for free download, use, and distribution.</p>
          <p><span class="font-semibold">Premium posts</span> require approval from the creator for distribution, even after download and use.</p>
        </div>
    `
    if (localStorage.getItem('showNotice') !== 'false')
    {
        document.querySelector('#filters').before(notice)
        document.querySelector('#closeNotice').addEventListener('click', ()=>{
            document.querySelector('#notice').remove()
            localStorage.setItem('showNotice', 'false')
        })
    }
  </script>
</div>

