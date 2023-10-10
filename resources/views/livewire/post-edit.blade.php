<x-slot name="title">Edit Post</x-slot>

<div>
    <x-split-screen>
        <x-split-screen-left>  
          <form wire:submit.prevent="submit">
              {{ $this->form }}
          
            
               

              
            
          </form>
          <x-livewire-primary-button type="button" wire:click="deletePost" class="mt-4 bg-red-600 hover:bg-red-700" type="submit">
            Delete Post
        </x-livewire-primary-button>
 
        </x-split-screen-left>
        <x-split-screen-right>
          
        </x-split-screen-right>
      </x-split-screen>
</div>

