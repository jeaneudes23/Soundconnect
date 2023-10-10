<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Community;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditCommunity extends Component implements HasForms
{
    use InteractsWithForms;
    use AuthorizesRequests;
    public $community;
    public $name;
    public $handle_name;
    public $header_image;
    public $cover_image;
    public $bio;
    public $description;
    public $tags;

    public function mount($handle_name)
    {
        
        $this->handle_name = $handle_name;
        $this->community = Community::where('handle_name',$this->handle_name)->first();

        $this->form->fill([
            'bio' =>$this->community->bio,
            'description' =>$this->community->description,
            'name' =>$this->community->name,
            'handle_name' =>$this->community->handle_name,
            'tags' =>$this->community->tags,
            'header_image' => $this->community->headerImage(),
            'cover_image' => $this->community->coverImage(),
        ]);
    }
    public function getFormSchema()
    {
        return ([
            Wizard::make([
                Step::make('Name')
                    ->schema([
                        TextInput::make('name')
                            ->hint('Community name')
                            ->label("Community Name")
                            ->required(),
                        TextInput::make('handle_name')
                            ->hint('You can not change the handlename')
                            ->label('Handle Name')
                            ->disabled(),
                    ]),
                Step::make("Description")
                    ->schema([
                        RichEditor::make('bio')
                            ->rules(['required', 'max: 255', 'string'])
                            ->label("Bio")
                            ->hint('Short bio, describe the important things to know before joining this community')
                            ->required()
                            ->columnSpan(2),
                        RichEditor::make('description')
                            ->label("description")
                            ->hint('More About the Community, Rules to be followed')
                            ->columnSpan(2),
                        TagsInput::make('tags')
                            ->separator(',')
                            ->label('tags')
                            ->suggestions([
                                'Hip Hop',
                                'Afro',
                            ]),
                    ]),
                Step::make("Profile & Cover Images")
                    ->schema([
                        FileUpload::make('header_image')
                            ->preserveFilenames()
                            ->image()
                            ->label("Community Header Image")
                            ->directory('communities/header_images'),
                        FileUpload::make('cover_image')
                            ->preserveFilenames()
                            ->image()
                            ->label("Community cover Image")
                            ->directory('communities/cover_images'),
                    ]),
            ])->skippable()->submitAction(new HtmlString("<button id='btn' class='mb-2 float-left relative inline-flex items-center px-4 text-sm py-2 bg-primary border border-transparent rounded-md font-semibold text-white capitalize tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150']) }}>
            <span wire:loading.class='opacity-0'>Save Changes</span>
        <div wire:loading class='absolute inset-0 m-auto h-3/5 aspect-square animate-spin border-t-primary border-4 rounded-full'></div>
        </button>
        ")),
        ]);
    }
    public function render()
    {
       
        $this->authorize('update', $this->community);
        return view('livewire.edit-community');
    }
    public function submit()
    {
        $this->community->update($this->form->getState());
        return redirect()->route('community.show',['handle_name' => $this->handle_name])->with('message','Changes saved');
    }
}

