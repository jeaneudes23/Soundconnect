<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Models';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Create Post')
                ->columns(2)
                ->schema([
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->required(),
                    Select::make('community_id')->relationship('community', 'name'),
                    TagsInput::make('tags')
                    ->separator(',')
                        ->label('tags'),
                    Select::make('type')->options([
                        'instrumental' => 'Instrumental',
                        'vocal' => 'Vocal',
                    ]),
                    Select::make('License')->options([
                        'basic' => 'Basic',
                        'premium' => 'Premium',
                    ]),
                    TextInput::make('bpm')->label('Tempo'),
                    TextInput::make('caption')->label('caption'),
                    FileUpload::make('audio_file')
                    ->label('file Upload')
                    ->directory('audios'),
                ]),
            //
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('community.name')->sortable()->searchable(),
                TextColumn::make('user.username')->sortable()->searchable(),
                TextColumn::make('caption')->limit(10)->searchable(),
                TextColumn::make('created_at')->sortable()->since(),
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),     
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [
                //
            ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
