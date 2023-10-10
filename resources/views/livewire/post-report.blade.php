<x-slot name="title">Report Post</x-slot>

<div>
    <x-split-screen>
        <x-split-screen-left>
            <div>
                <div data-player="false" class="mb-6 rounded border bg-gray-100 border-gray-100 px-4 py-2 text-sm shadow">
                  <div class="flex justify-between">
                    <div class="flex items-center">
                      @if ($post->community_id)
                      <div>
                      @if ($post->community->headerImage())
                          <img class="h-8 w-8 rounded-full object-cover" src="{{asset($post->community->headerImage())}}" alt="" />
                      @else
                          <div class="rounded-full w-8 h-8 flex items-center justify-center uppercase text-white bg-primary">
                          <span class="text-center text-xs">{{ substr($post->community->name, 0, 2) }}</span>
                        </div>
                      @endif
                      </div>
                      <div class="ml-1">
                        <a class="hover:underline font-semibold" href="{{route('community.show',['handle_name'=>$post->community->handle_name])}}">{{$post->community->name}}</a>
                      </div>   
                      <span>-</span>
                      @endif
                      <div>
                        <a class="hover:underline" href="/profile/{{ $post->user->username }}">{{ $post->user->name }}.</a>
                      </div>
                      <span class="ml-2">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
                    </div>
                    @if ($post->audio_file)
                    <div>
                      <button class="grid place-content-center rounded-full bg-white p-2" data-play-source="{{asset($post->audio_file)}}">
                        <span data-play-icon>
                          <svg class="h-6 w-6 fill-primary" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier"><path class="fill-primary" d="M21.4086 9.35258C23.5305 10.5065 23.5305 13.4935 21.4086 14.6474L8.59662 21.6145C6.53435 22.736 4 21.2763 4 18.9671L4 5.0329C4 2.72368 6.53435 1.26402 8.59661 2.38548L21.4086 9.35258Z" fill=""></path></g>
                          </svg>
                        </span>
                        <span data-pause-icon class="hidden">
                          <svg class="h-6 w-6 fill-primary" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                              <path class="fill-primary" d="M2 6C2 4.11438 2 3.17157 2.58579 2.58579C3.17157 2 4.11438 2 6 2C7.88562 2 8.82843 2 9.41421 2.58579C10 3.17157 10 4.11438 10 6V18C10 19.8856 10 20.8284 9.41421 21.4142C8.82843 22 7.88562 22 6 22C4.11438 22 3.17157 22 2.58579 21.4142C2 20.8284 2 19.8856 2 18V6Z" fill=""></path>
                              <path d="M14 6C14 4.11438 14 3.17157 14.5858 2.58579C15.1716 2 16.1144 2 18 2C19.8856 2 20.8284 2 21.4142 2.58579C22 3.17157 22 4.11438 22 6V18C22 19.8856 22 20.8284 21.4142 21.4142C20.8284 22 19.8856 22 18 22C16.1144 22 15.1716 22 14.5858 21.4142C14 20.8284 14 19.8856 14 18V6Z" fill=""></path>
                            </g>
                          </svg>
                        </span>
                      </button>
                    </div>
                    @endif
                  </div>
                  <div class="mt-2 text-base">
                    @if ($post->audio_file)
                    <span class="font-semibold"> {{$post->genre}} - {{ $post->bpm }} BPM</span> 
                    @endif
                    <h3>
                      <a class="font-semibold hover:text-primary" href="{{route('post.show',['id'=>$post->id])}}"> {!! $post->caption !!}</a>
                    </h3>
                  </div>
                  @if ($post->audio_file)
                  <div class="mt-2">
                    <div disabled data-progress-container class="h-2 bg-gray-300 hover:cursor-pointer hover:shadow">
                      <div data-progress-bar class="h-full w-0 bg-primary"></div>
                    </div>
                  </div>
                    <div class="mt-2 flex items-center gap-4">    
                      <div class="rounded font-semibold bg-gray-600 px-2 py-0.5 text-white">{{ $post->type }}</div>
                      <ul class="flex items-center gap-1 ">
                        @if ($post->tags)
                        @foreach (explode(",", $post->tags) as $tag)
                        <li><span class="font-semibold">{{ '#'.$tag }}</span></li>
                        @endforeach
                        @endif         
                      </ul>
                      <div data-duration>
                      </div>
                      <a target="_blank" class="ml-auto rounded-lg font-semibold bg-primary px-2 py-2 text-white" href="{{ asset($post->audio_file) }}">{{'Download-'.$post->license}}</a>
                    </div>
                  @endif
                </div>
              </div>
              
            <div>

            
          <form wire:submit.prevent="submit">
              {{ $this->form }}
          
              <x-livewire-primary-button class="my-4 bg-red-600" type="submit">
                  Report
              </x-livewire-primary-button>
          </form>
        </div>
        </x-split-screen-left>
        <x-split-screen-right>
          
        </x-split-screen-right>
      </x-split-screen>
</div>
