<x-slot name="title">Notifications</x-slot>
<div class="text-sm">
    <x-split-screen>
        <x-split-screen-left>
            <ul class="space-y-2">
                @forelse ($notifications as $notification)
                @if ($notification->action == "follow")
                <li class="bg-gray-100">
                    <div class="px-4 py-4 flex gap-1">
                        <a class="font-semibold hover:underline" href="{{route('profile.show', ['username'=>$notification->user->username])}}">{{$notification->user->name}}</a>
                        <span>Followed</span>
                        <span class="font-semibold text-primary">You</span>
                        <span class="ml-auto">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                    </div>
                </li>  
                @endif
                @if ($notification->action == "like")
                <li class="bg-gray-100">
                    <div class="px-4 py-4 flex gap-1">
                        <a class="font-semibold hover:underline" href="{{route('profile.show', ['username'=>$notification->user->username])}}">{{$notification->user->name}}</a>
                        <span>Liked</span>
                        <a class="font-semibold text-primary hover:underline" href="{{route('post.show',['id'=>$notification->post_id])}}">Your Post</a>
                        <span class="ml-auto">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                    </div>
                </li>  
                @endif
                @if ($notification->action == "comment")
                <li class="bg-gray-100">
                    <div class="px-4 py-4 flex gap-1">
                        <a class="font-semibold hover:underline" href="{{route('profile.show', ['username'=>$notification->user->username])}}">{{$notification->user->name}}</a>
                        <span>Commented on</span>
                        <a class="font-semibold text-primary hover:underline" href="{{route('post.show',['id'=>$notification->post_id])}}">Your Post</a>
                        <span class="ml-auto">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                    </div>
                </li>  
                @endif
                @if ($notification->action == "report")
                <li class="bg-gray-100">
                    <div class="px-4 py-4 flex flex-wrap gap-1">
                        <a class="font-semibold hover:underline" href="{{route('profile.show', ['username'=>$notification->user->username])}}">{{$notification->user->name}}</a>
                        <span>has reported</span>
                        <a class="font-semibold text-primary hover:underline" href="{{route('post.show',['id'=>$notification->post_id])}}">Your Post</a>
                        <span class="basis-full flex-shrink-0">If the post breaks any rules, please remove it in time to avoid being permanenlty banned</span>
                        <span class="ml-auto">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</span>
                    </div>
                </li>  
                @endif
                
                @empty
                <li><div>No New Notifications</div></li>
                    
                @endforelse
            </ul>
        </x-split-screen-left>
        <x-split-screen-right>
        </x-split-screen-right>
    </x-split-screen>
</div>
