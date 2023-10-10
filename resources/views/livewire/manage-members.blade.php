<x-slot name="title">Manage Community</x-slot>
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
            <div class="flex items-start py-2 gap-2 px-2">
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
                <ul class="divide-x-2 flex font-semibold tracking-wider">
                <li><a class="block px-4 py-2 hover:text-primary" href="{{route('community.modPosts',['handle_name' =>$community->handle_name])}}">Posts</a></li>
                <li><a class="block px-4 py-2 text-primary" href="{{route('community.modMembers', ['handle_name'=>$community->handle_name])}}">Members</a></li>
                @can('update', $community)
                <li><a class="block px-4 py-2 hover:text-primary" href="{{route('community.edit', ['handle_name'=>$community->handle_name])}}">Edit</a></li>        
                @endcan
                </ul>
            </div>
        </div>
        <div>
            <div>
                <div class="flex gap-4">
                    <x-text-input placeholder="Search by name,username, tags" class="placeholder:text-sm w-full" type="text" wire:model.debounce.350ms="search"/>
                    <x-livewire-primary-button>Search</x-livewire-primary-button>
                </div>
            </div>
            <div>
        
                    @forelse ($members as $user)
                    <div class="my-4 rounded bg-gray-100 px-4 py-2 text-sm text-gray-600">
                        <div class="mb-1 flex items-center gap-1">
                            <div class="relative  w-8">
                                @if ($user->profile->profileImage())
                                    <img class=" h-8 rounded-full object-cover" src="{{asset($user->profile->profileImage())}}" alt="profile image" />
                                @else
                                    <div class="rounded-full h-8  w-full flex items-center justify-center  uppercase text-white bg-primary">
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
                        <ul class="flex gap-1 mt-1">
                            @forelse (explode(",", $user->profile->tags) as $tag)
                                @if ($tag !== '')
                                    <li><span class="bg-gray-700 p-1 rounded text-xs text-gray-100 capitalize">{{ $tag }}</span></li>
                                @endif
                            @empty
                            @endforelse
                        </ul>
                        <div>
                            <x-primary-button wire:key="{{$user->id}}" wire:click="banUser({{$user->id}})" class="bg-red-600 text-xs">Ban user</x-primary-button>
                        </div>
                    </div>
                @empty
                    <span>No Users Found</span>
                @endforelse
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
