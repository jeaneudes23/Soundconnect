<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Filament\Forms\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class EditProfile extends Component implements HasForms
{
    use InteractsWithForms;

    public $profile;
    public $bio;
    public $profile_image;
    public $tags;
    public function mount()
    {
        $this->profile = auth()->user()->profile;
        $this->form->fill([
            'bio' =>auth()->user()->profile->bio,
            'tags' =>auth()->user()->profile->tags,
            'profile_image' => auth()->user()->profile->profileImage(),
        ]);
    }
    public function getFormSchema()
    {
        return [
            Grid::make(1)->schema([
                FileUpload::make('profile_image')
                    ->image()
                    ->directory('users/images'),        
                RichEditor::make('bio')->hint('Brief Description, Social Media')->required(),
                TagsInput::make('tags')
                ->separator(',')
                ->hint('What do you do, genres you are interested in,Instruments you play')
            ]),
        ];
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
    public function submit()
    {
        auth()->user()->profile()->update($this->form->getState());
        foreach($this->tags as $tag){
            Tag::create([
                'type' => 'user',
                'text' => $tag
            ]);
        };
        return redirect()->route('profile.show', ['username' => auth()->user()->username])->with('message','Changes Saved');
    }
}
