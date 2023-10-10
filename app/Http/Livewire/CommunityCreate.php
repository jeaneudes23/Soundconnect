<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;
use App\Models\Community;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;

class CommunityCreate extends Component implements HasForms
{
    use InteractsWithForms;

    public $name;
    public $owner_id;
    public $handle_name;
    public $header_image;
    public $cover_image;
    public $tags;
    public $bio;
    public function mount()
    {
        $this->form->fill([
            'owner_id' => Auth::user()->id,

        ]);
    }
    public function getFormSchema()
    {
        return ([

            Hidden::make('owner_id'),

            Wizard::make([
                Step::make('Name')
                    ->schema([
                        TextInput::make('name')
                            ->hint('Community name')
                            ->label("Community Name")
                            ->required(),
                        TextInput::make('handle_name')
                            ->hint('no spaces between characters')
                            ->label('Handle Name')
                            ->required()
                            ->rules(['required', 'string', 'regex:/^[^\s]+$/', 'unique:' . Community::class]),
                    ]),
                Step::make("Description")
                    ->schema([

                        RichEditor::make('bio')
                            ->rules(['required', 'max: 255', 'string'])
                            ->label("Bio")
                            ->hint('Short bio, describe the important things to know before joining this community')
                            ->columnSpan(2),
                        RichEditor::make('description')
                            ->required()
                            ->label("Description")
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
            ])->submitAction(new HtmlString("<button id='btn' class='mb-2 float-left relative inline-flex items-center px-4 text-sm py-2 bg-primary border border-transparent rounded-md font-semibold text-white capitalize tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150']) }}>
            <span wire:loading.class='opacity-0'>Create New Community</span>
        <div wire:loading class='absolute inset-0 m-auto h-3/5 aspect-square animate-spin border-t-primary border-4 rounded-full'></div>
        </button>
        ")),
        ]);
    }
    public function submit()
    {

        Community::create($this->form->getState());
        foreach ($this->tags as $tag) {
            Tag::create([
                'type' => 'community',
                'text' => $tag
            ]);
        };
        return redirect()->route('community.show', ['handle_name' => $this->handle_name]);
    }

    public function render()
    {
        return view('livewire.community-create');
    }
}
