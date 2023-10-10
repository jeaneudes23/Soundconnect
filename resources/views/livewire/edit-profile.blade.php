<x-slot name="title">Edit Profile</x-slot>
<div>
    <x-split-screen>
      <x-split-screen-left>
        <form wire:submit.prevent="submit">
            {{ $this->form }}
        
            <x-livewire-primary-button class="my-4" type="submit">
                Save changes
            </x-livewire-primary-button>
        </form>
      </x-split-screen-left>
      <x-split-screen-right>
        <div class="py-4">
            <div class="relative mx-auto w-16">
              @if ($profile->profileImage())
                  <img class=" h-16  w-full block rounded-full object-cover" src="{{asset($profile->profileImage())}}" alt="profile image" />
              @else
                  <div class="rounded-full   h-16  w-full flex items-center justify-center  uppercase text-white bg-primary">
                  <span class="text-center text-xl">{{ substr($profile->user->name, 0, 2) }}</span>
                </div>
              @endif
              </div>          
            <div>
          <div class="px-2 grid text-center mt-4 text-sm">
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
  
