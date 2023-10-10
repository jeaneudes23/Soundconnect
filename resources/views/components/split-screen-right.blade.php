<div class="sticky top-[5rem] hidden basis-1/3 overflow-hidden rounded border border-gray-100 shadow md:block">
    {{$slot}}
    <div>
    </div>
    <div class="border-t-2 flex flex-col gap-4 px-2 py-8 text-center lg:px-6">
        <a href="{{route('community.create')}}" class="rounded-full border-2 border-primary px-4 py-2 font-semibold">Create Community</a>
        @if (request()->routeIs('community.show'))
        <a href="{{route('post.create',['community_id'=>$id])}}" class="rounded-full border-2 border-primary bg-primary px-4 py-2 font-semibold text-white">Create Post</a>
        @else
        <a href="{{route('post.create')}}" class="rounded-full border-2 border-primary bg-primary px-4 py-2 font-semibold text-white">Create Post</a>
        @endif
    </div>
    <div class="bg-gray-100 px-2 py-2 text-center text-sm">Copyright @Jean Eudes 2023</div>
</div>
