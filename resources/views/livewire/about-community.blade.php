<x-slot name="title">{{$community->handle_name}}</x-slot>

<div>
    <x-split-screen>
      <x-split-screen-left>
        <x-community-header :joined="$joined" :community="$community"></x-community-header>
        <div class=" rounded mb-8 ">
          <div>{{$community->members->count()." Members"}}</div>          
          <div>{{$community->posts->count()." Posts"}}</div>          
          <div><span>Created By</span> <a class="font-semibold hover:underline" href="{{route('profile.show', ['username'=>$community->owner->username])}}">{{$community->owner->name}}</a> <span>{{\Carbon\Carbon::parse($community->created_at)->diffForHumans()}}</span></div>
          <div class="prose my-4">
            {!! $community->description !!}
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
  </div>
