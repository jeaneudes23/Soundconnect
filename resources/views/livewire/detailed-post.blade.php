<x-slot name="title">{{$post->id}}</x-slot>
<x-split-screen>
    <x-split-screen-left>
        <div>
            <x-post-card :post="$post" wire:key="{{ $post->id }}" />
            <div>
                <form class="my-6 " wire:submit.prevent="submit">
                    {{ $this->form }}
                    
                    <x-livewire-primary-button class="mt-4" type="submit">
                        Comment
                    </x-livewire-primary-button>
                </form>
            </div>
            <div class="mb-8 divide-y-2 bg-white">
                @forelse ($comments as $comment)
                <div class="py-2 ">
                    <div class="text-sm ">
                        <a class="hover:underline font-semibold" href="/profile/{{ $comment->user->username }}">{{ __('u/').$comment->user->username }}.</a>
                        <span class="inline">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>    
                    </div>
                    <div>
                        <p class="">{{$comment->comment}}</p>
                    </div>
                
                </div>   
                @empty
                    <p>No Comments On this Post</p>
                @endforelse
            </div>
        </div>        
    </x-split-screen-left>
    <x-split-screen-right>
    </x-split-screen-right>
</x-split-screen>