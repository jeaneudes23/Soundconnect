@props(['community','joined'])
<div>
    <div class="relative h-56">
        @if ($community->coverImage())
            <img class="h-full w-full object-cover" src="{{asset('storage/'.$community->coverImage())}}" alt="profile image" />
        @else
        <div class="absolute inset-0 bg-gray-100">
          </div>
        @endif
        
    </div>
    <div class="flex items-start py-2 gap-2 px-2">
        <div class="relative w-32">
        @if ($community->headerImage())
            <img class="absolute h-32 w-full -top-16 block border-clraccent object-cover border-2" src="{{asset('storage/'.$community->headerImage())}}" alt="profile image" />
        @else
            <div class="rounded-full absolute h-32 w-full -top-16 flex items-center justify-center  uppercase text-white bg-primary">
            <span class="text-center text-xl">{{ substr($community->name, 0, 2) }}</span>
          </div>
        @endif
        </div>
        <div class="ml-1 flex flex-col">
        <span class="font-semibold">{{$community->name}}</span>
        <span class="">{{'@'.$community->handle_name}}</span>
        </div>
        <div class="ml-auto">
        <x-joinLeave-button wire:click="joinLeave" :joined="$joined"></x-joinLeave-button>
        </div>
        
    </div>
    <div class="prose my-6">{!! $community->bio !!}</div>
    <hr class="border-t-2">
    <div class="my-4">
        <ul class="divide-x-2 flex gap-2 font-semibold tracking-wider">
        <li><a class="block px-4 py-2 hover:text-primary" href="{{route('community.show',['handle_name' =>$community->handle_name])}}">Posts</a></li>
        <li><a class="block px-4 py-2 hover:text-primary" href="{{route('community.about', ['handle_name'=>$community->handle_name])}}">About</a></li>
        @can('update', $community)
        <li><a class="block px-4 py-2 hover:text-primary" href="{{route('community.modMembers', ['handle_name'=>$community->handle_name])}}">Mod Tools</a></li>

        @endcan
        </ul>
    </div>
</div>