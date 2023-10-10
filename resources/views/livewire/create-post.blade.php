<x-slot name="title">New Post</x-slot>
<div>
    <x-split-screen>
        <x-split-screen-left>
            <div>
                <h2 class="text-2xl text-primary font-semibold mb-6">Create Post</h2>
            </div>

            <div>
                <form wire:submit.prevent="submit">
                    {{ $this->form }}
                </form>
            </div>
        </x-split-screen-left>
        <x-split-screen-right>
        </x-split-screen-right>
    </x-split-screen>
</div>
