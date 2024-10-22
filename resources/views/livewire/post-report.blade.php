<x-slot name="title">Report Post</x-slot>

<div>
  <x-split-screen>
    <x-split-screen-left>
      <livewire:post.show-post :post="$post"/>
      <div class="mt-6">
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
