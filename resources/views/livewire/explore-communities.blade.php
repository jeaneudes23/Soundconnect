<x-slot name="title">Explore Communities</x-slot>
<div>
    <x-split-screen>
        <x-split-screen-left>
            <div>
                <div class="flex gap-4">
                    <x-text-input placeholder="Search by name,handle name, tags" class="placeholder:text-sm w-full" type="text" wire:model.debounce.350ms="search"/>
                    <x-livewire-primary-button>Search</x-livewire-primary-button>
                </div>

            </div>
            <div>
                @forelse ($communities as $community)
                    <div class="my-4 rounded bg-gray-100 px-4 py-2 text-sm text-gray-600">
                        <div class="relative flex gap-4">
                            <div class="relative w-16">
                                @if ($community->headerImage())
                                    <img class="h-16 w-full  block border-clraccent object-cover border-2" src="{{asset('storage/'.$community->headerImage())}}" alt="profile image" />
                                @else
                                    <div class="rounded-full h-16 w-full  flex items-center justify-center  uppercase text-white bg-primary">
                                    <span class="text-center text-xl">{{ substr($community->name, 0, 2) }}</span>
                                  </div>
                                @endif
                                </div>
                                <div>
                                    <h3 class="font-semibold hover:underline"><a href="{{route('community.show',['handle_name' => $community->handle_name])}}">{{$community->name.'@'.$community->handle_name}}</a></h3>
                                    <div>
                                        <span>{{$community->members->count()." Member(s)"}}</span>          
                                        <span>{{$community->posts->count()." Post(s)"}}</span>
                                        <div class="mt-2">
                                            @forelse (explode(",", $community->tags) as $tag)
                                        @if ($tag !== '')
                                        <span class="bg-gray-700 p-1 rounded text-xs text-gray-100 capitalize">{{ $tag }}</span>
                                        @endif
                                    @empty
                                    @endforelse
                                            </div>          
                                                                                
                                      </div>
                                </div>
                        </div>
                    </div>
                @empty
                    <span>No Users Found</span>
                @endforelse
                <div class="mb-6">
                    
                </div>
            </div>
        </x-split-screen-left>
        <x-split-screen-right>
        </x-split-screen-right>
    </x-split-screen>

</div>
