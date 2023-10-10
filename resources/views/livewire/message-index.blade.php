<x-slot name="title">Messages</x-slot>
<div>
    <x-split-screen>
        <x-split-screen-left>
            <div class="font-semibold text-xl mb-4">Latest Chats</div>
            <ul class="divide-y text-sm">
                @forelse ($sortedUsersInContact as $user)
                    <li class="relative flex gap-2 px-2 py-2 hover:bg-gray-100">
                        <div class="relative mx-auto w-16">
                            @if ($user->profile->profileImage())
                                <img class=" h-16  w-full block rounded-full object-cover" src="{{asset($user->profile->profileImage())}}" alt="profile image" />
                            @else
                                <div class="rounded-full   h-16  w-full flex items-center justify-center  uppercase text-white bg-primary">
                                <span class="text-center text-xl">{{ substr($user->name, 0, 2) }}</span>
                              </div>
                            @endif
                        </div>                         
                        <div class="flex-grow">
                            <h3>{{ $user->name }}</h3>
                            @php
                                $latestMessage = collect();
                                
                                $latestSentMessage = $user
                                    ->sentMessages()
                                    ->where('receiver_id', auth()->user()->id)
                                    ->orderByDesc('created_at')
                                    ->first();
                                
                                $latestReceivedMessage = $user
                                    ->receivedMessages()
                                    ->where('sender_id', auth()->user()->id)
                                    ->orderByDesc('created_at')
                                    ->first();
                                
                                if ($latestSentMessage) {
                                    $latestMessage->push($latestSentMessage);
                                }
                                
                                if ($latestReceivedMessage) {
                                    $latestMessage->push($latestReceivedMessage);
                                }
                                
                                $latestMessage = $latestMessage->sortByDesc('created_at')->first();
                            @endphp
                            <div class="flex">
                                @if ($latestMessage->sender_id == auth()->user()->id)
                                <h5 class="font-semibold text-primary whitespace-pre">{{'You: '}}</h5>
                                @endif
                                <h5 class="prose text-sm">{!! \Illuminate\Support\Str::limit($latestMessage->content, 10, $end='..')  !!}</h5>
                                <h5 class="ml-auto">{{ \Carbon\Carbon::parse($latestMessage->created_at)->diffForHumans()}}</h5>
                            </div>
                            
                        </div>
                        <a class="absolute inset-0" href="{{ route('messages.show', ['username' => $user->username]) }}"></a>
                    </li>
                @empty
                    <li>Start Conversation to see</li>
                @endforelse
            </ul>
        </x-split-screen-left>
        <x-split-screen-right>
        </x-split-screen-right>
    </x-split-screen>
</div>
