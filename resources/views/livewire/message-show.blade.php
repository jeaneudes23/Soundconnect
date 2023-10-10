<x-slot name="title">{{'Messages-'.$receiver->username}}</x-slot>
<div>
    <x-split-screen>
        <x-split-screen-left>
            <div class="font-semibold bg-primary text-white px-2 py-4">
                {{$receiver->name}}
            </div>
            <ol id="messagebox"  class="grid gap-4 px-2 py-4 max-h-[300px] overflow-y-auto">
                @forelse ($messages as $message)
                @if ($message->sender_id == $sender_id)
                    <li class="w-4/5 p-2 rounded-lg justify-self-end font-semibold shadow bg-gray-100">
                        <div class="prose text-sm content">
                            {!! $message->content !!}
                        </div>
                        <span class="text-right text-xs block">{{$message->created_at}}</span>
                    </li>
                   
                @else
                    <li class="w-4/5 p-2 rounded-lg  font-semibold shadow bg-primary max-w-full ">
                        <div class="prose text-sm text-white">
                            {!! $message->content !!}
                        </div>
                        <span class="text-right text-xs block text-white">{{$message->created_at}}</span>
                    </li>       
                @endif
                @empty
                <li class="text-center">No Messages Yet, Start the conversation</li>
                @endforelse
            </ol>
            <div class="px-2 border-t-2 py-4">
                <form wire:submit.prevent="submit">
                    <div>
                        {{ $this->form }}
                    </div>            
                    <x-livewire-primary-button class="my-4" type="submit">
                        Send
                    </x-livewire-primary-button>
                </form>
            </div>
        </x-split-screen-left>
        <x-split-screen-right>
            <div class="text-sm text-center grid py-2 px-2 relative hover:bg-gray-100">
                <div class="relative mx-auto w-16">
                    @if ($receiver->profile->profileImage())
                        <img class=" h-16  w-full block rounded-full object-cover" src="{{asset($receiver->profile->profileImage())}}" alt="profile image" />
                    @else
                        <div class="rounded-full   h-16  w-full flex items-center justify-center  uppercase text-white bg-primary">
                        <span class="text-center text-xl">{{ substr($receiver->name, 0, 2) }}</span>
                      </div>
                    @endif
                    </div> 
                <h3 class="font-semibold mt-2">{{$receiver->name}}</h3>
                <h3>{{'@'.$receiver->username}}</h3>
                <h3>{{'joined '.\Carbon\Carbon::parse($receiver->created_at)->diffForHumans()}}</h3>
                <a class="absolute inset-0" href="{{route('profile.show',['username'=>$receiver->username])}}"></a>
            </div>
        </x-split-screen-right>
    </x-split-screen>
</div>
<script>
    document.addEventListener('livewire:load', function () {
        document.querySelector('#messagebox').scrollTop = document.querySelector('#messagebox').scrollHeight - document.querySelector('#messagebox').clientHeight;
    })
</script>