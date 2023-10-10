<x-slot name="title">Manage Community Posts</x-slot>
<x-split-screen>
    <x-split-screen-left>
        <div>
            <div class="relative h-56">
                @if ($community->coverImage())
                    <img class="h-full w-full object-cover" src="{{asset($community->coverImage())}}" alt="profile image" />
                @else
                <div class="absolute inset-0 bg-gray-100">
                  </div>
                @endif
                
            </div>
            <div class="flex items-start py-2 px-2">
                <div class="relative w-32">
                @if ($community->headerImage())
                    <img class="absolute h-32 w-full -top-16 block border-clraccent object-cover border-2" src="{{asset($community->headerImage())}}" alt="profile image" />
                @else
                    <div class="rounded-full absolute h-32 w-full -top-16 flex items-center justify-center  uppercase text-white bg-primary">
                    <span class="text-center text-xl">{{ substr($community->name, 0, 2) }}</span>
                  </div>
                @endif
                </div>
                <div class="flex flex-col ml-2">
                <span class="font-semibold">{{$community->name}}</span>
                <span class="">{{'@'.$community->handle_name}}</span>
                </div>
 
                
            </div>
            <div class="my-4">
                <ul class="divide-x-2 flex gap-2 font-semibold tracking-wider">
                <li><a class="block px-4 py-2 text-primary" href="{{route('community.modPosts',['handle_name' =>$community->handle_name])}}">Posts</a></li>
                <li><a class="block px-4 py-2 hover:text-primary" href="{{route('community.modMembers', ['handle_name'=>$community->handle_name])}}">Members</a></li>
                @can('update', $community)
                <li><a class="block px-4 py-2 hover:text-primary" href="{{route('community.edit', ['handle_name'=>$community->handle_name])}}">Edit</a></li>        
                @endcan
                </ul>
            </div>
        </div>
        <div>
            <div>
                <div class="flex gap-4">
                    <x-text-input placeholder="Search by user,genre,tags,caption,tempo"  class="placeholder:text-sm w-full" type="text" wire:model.debounce.350ms="search"/>
                    <x-livewire-primary-button>Search</x-livewire-primary-button>
                </div>
                <div class="rounded py-4 shadow-sm">
                    <div class="text-sm flex flex-wrap mt-3 gap-2">
                      <div class="items-center gap-2">
                          <h3 class="font-semibold">Post Type: </h3>
                          <select class="text-xs" name="" wire:model="postType" id="">
                              <option value="">All</option>
                              <option value="song">Songs</option>
                              <option value="instrumental">Instrumentals</option>
                              <option value="text">Text</option>
                              <option value="vocal">Vocals/Acapella</option>
                          </select>
                      </div>
                 
                      <div class="items-center gap-2">
                          <h3 class="font-semibold">Sort by </h3>
                          <select class="text-xs" name="" wire:model="sortBy" id="">
                              <option value="created_at">New</option>
                              <option value="comments_count">Number of Comments</option>
                              <option value="liked_by_users_count">Number of likes</option>
                          </select>
                      </div>
                      <div class="items-center gap-2">
                        <h3 class="font-semibold">Time </h3>
                        <select class="text-xs" name="" wire:model="timeRange" id="">
                            <option value="" selected="">All Time</option>
                            <option value="hour">Last hour</option>
                            <option value="day">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                        </select>
                        
                    </div>
                      <div class="items-center gap-2">
                          <h3 class="font-semibold">Order by: </h3>
                          <select class="text-xs" name="" wire:model="orderBy" id="">
                              <option value="asc">Ascending</option>
                              <option value="desc">Descending</option>
                          </select>
                      </div>
                      <div class="text-primary font-semibold text-lg" wire:loading>
                          Loading
                      </div>
                  </div>
                  </div>


            </div>
            <div class="space-y-6">
                @forelse ($posts as $post)
                <div >
                    <livewire:post.show-post :post="$post" :wire:key="$post->id"/>
                    <x-primary-button wire:click="unlink({{$post->id}})" class="bg-red-600 text-xs mt-1">Remove</x-primary-button>
                </div>
                @empty
                    <span>No posts Found</span>
                @endforelse
               
                <div class="mb-6">
                <x-primary-button wire:click='showMore'>Show more</x-primary-button>
                </div>
            </div>
        </div>
        
    </x-split-screen-left>
    <x-split-screen-right :id="$community->id">
        <div class="py-4">
          <div class="mx-auto relative w-16">
            @if ($community->headerImage())
                <img class="h-16 w-full  block border-clraccent object-cover border-2" src="{{asset($community->headerImage())}}" alt="profile image" />
            @else
                <div class="rounded-full h-16 w-full  flex items-center justify-center  uppercase text-white bg-primary">
                <span class="text-center text-xl">{{ substr($community->name, 0, 2) }}</span>
              </div>
            @endif
            </div>
          <div class="grid text-center px-2 mt-4 text-sm">
            <span class="font-semibold text-base">{{$community->handle_name}}</span>
            <span>{{'Created '. \Carbon\Carbon::parse($community->created_at)->diffForHumans() }}</span>
            <span class="">{{$community->members->count()}} Members</span>
            <span class="">{{$community->posts->count()}} Posts</span>
          </div>
        </div>
      </x-split-screen-right>
</x-split-screen>
