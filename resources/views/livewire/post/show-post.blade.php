<div>
  <div wire:key="{{$post->id.' player'}}" data-player="false" data-play-status="false" class="group/play rounded border bg-gray-100 border-gray-100 px-4 py-2 text-sm shadow">
    <div class="flex gap-2 justify-between">
      <div class="flex flex-wrap items-center">
        @if ($post->community_id)
        <div class="flex items-center">
          <div>
            @if ($post->community->headerImage())
                <img class="h-8 w-8 rounded-full object-cover" src="{{asset($post->community->headerImage())}}" alt="" />
            @else
                <div class="rounded-full w-8 h-8 flex items-center justify-center uppercase text-white bg-primary">
                <span class="text-center text-xs">{{ substr($post->community->name, 0, 2) }}</span>
              </div>
            @endif
          </div>
          <div class="ml-2">
            <a class="hover:underline text-primary-600 font-semibold whitespace-pre" href="{{route('community.show',['handle_name'=>$post->community->handle_name])}}">{{$post->community->name." "}}</a>
          </div>   
        </div>    
        @endif
        <div>
          @if (!$post->community_id)
          
            <a class="hover:underline font-semibold whitespace-pre" href="/profile/{{ $post->user->username }}">{{$post->user->username.' ' }}</a>
          
          @else
          
            <a class="hover:underline font-semibold whitespace-pre" href="/profile/{{ $post->user->username }}">{{$post->user->username.' ' }}</a>
          
          @endif
        </div>
        <span class="text-xs">{{'-'.\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
      </div>
      @if ($post->audio_file)
      <div>
        <button class="grid place-content-center rounded-full bg-white p-2" data-play-source="{{asset('storage/'.$post->audio_file)}}">
          <span class=" group-data-[play-status=true]/play:hidden" data-play-icon>
            <svg class="h-6 w-6 fill-primary" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier"><path class="fill-primary" d="M21.4086 9.35258C23.5305 10.5065 23.5305 13.4935 21.4086 14.6474L8.59662 21.6145C6.53435 22.736 4 21.2763 4 18.9671L4 5.0329C4 2.72368 6.53435 1.26402 8.59661 2.38548L21.4086 9.35258Z" fill=""></path></g>
            </svg>
          </span>
          <span class=" group-data-[play-status=false]/play:hidden">
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
    <div class="text-base">
      <h3>
        @if ($post->community_id)
            @if ($post->user->id === $post->community->owner->id)
            <a class="font-semibold text-primary hover:text-primary-700" href="{{route('post.show',['id'=>$post->id])}}"> {!! $post->caption !!}</a>
            @else
            <a class="font-semibold hover:text-primary" href="{{route('post.show',['id'=>$post->id])}}"> {!! $post->caption !!}</a>
            @endif
        @else
        <a class="font-semibold hover:text-primary" href="{{route('post.show',['id'=>$post->id])}}"> {!! $post->caption !!}</a>
        @endif
      </h3>
      @if ($post->audio_file)
      <div class="font-semibold"> <span class="text-primary">{{$post->genre}}</span>  - {{ $post->bpm }} BPM</div> 
      @endif
    </div>
    @if ($post->audio_file)
    <div class="mt-2">
      <button disabled data-progress-container class="h-2 w-full bg-gray-300 hover:cursor-pointer hover:shadow">
        <div data-progress-bar class="h-full w-0 bg-primary"></div>
      </button>
    </div>
   
   
      <div class="mt-2 flex flex-wrap items-center gap-4">    
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
        <a target="_blank" class="ml-auto rounded-lg font-semibold bg-primary px-2 py-2 text-white" download="" href="{{ asset('storage/'.$post->audio_file) }}">{{'Download-'.$post->license}}</a>
      </div>

    @endif
    <div class="mt-3 flex items-center gap-4">
      <div class="flex items-center gap-1">
        <x-like-button :likes="$likes" :likedByUser="$likedByUser" wire:click="likePost"></x-like-button>
        <span>{{$likes}}</span>
      </div>
      <div class="flex items-center">
        <a class="inline-flex gap-1 hover:underline" href="{{route('post.show',['id'=>$post->id])}}">
          <span>
 
            <svg class="h-5 w-5" version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" class="fill-primary" fill="#231F20" d="M60,0H4C1.789,0,0,1.789,0,4v40c0,2.211,1.789,4,4,4h8v12 c0,1.617,0.973,3.078,2.469,3.695C14.965,63.902,15.484,64,16,64c1.039,0,2.062-0.406,2.828-1.172L33.656,48H60c2.211,0,4-1.789,4-4 V4C64,1.789,62.211,0,60,0z"></path> </g></svg>
          </span>
          {{$post->comments->count().' Comments'}} 
        </a>
      </div>
      <div class="relative group/post flex ml-auto items-center gap-2">
        <button class="font-bold inline-flex flex-col">
          <span>
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12.0001 9.32C13.1901 9.32 14.1601 8.35 14.1601 7.16C14.1601 5.97 13.1901 5 12.0001 5C10.8101 5 9.84009 5.97 9.84009 7.16C9.84009 8.35 10.8101 9.32 12.0001 9.32Z" class="stroke-primary" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6.78988 18.9999C7.97988 18.9999 8.94988 18.0299 8.94988 16.8399C8.94988 15.6499 7.97988 14.6799 6.78988 14.6799C5.59988 14.6799 4.62988 15.6499 4.62988 16.8399C4.62988 18.0299 5.58988 18.9999 6.78988 18.9999Z" class="stroke-primary" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M17.21 18.9999C18.4 18.9999 19.37 18.0299 19.37 16.8399C19.37 15.6499 18.4 14.6799 17.21 14.6799C16.02 14.6799 15.05 15.6499 15.05 16.8399C15.05 18.0299 16.02 18.9999 17.21 18.9999Z" class="stroke-primary" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
          </span>
        </button>
        <div class="bg-white p-2 rounded-sm shadow absolute right-0 top-8 hidden group-focus-within/post:block">
        @can('update', $post)
        <a class="w-full whitespace-pre block px-4 py-2 hover:bg-gray-100" href="{{route('post.edit', ['post_id' => $post->id])}}">Edit Post</a>
        @endcan
        @cannot('update', $post)
        <a href="{{route('post.report',['post_id'=>$post->id])}}" class="inline-block bg-red-600 hover:bg-red-700 text-white tracking-wider rounded px-4 py-2 font-semibold">Report</a>
        @endcannot
        </div>
      </div>
    </div>
  </div>
</div>
