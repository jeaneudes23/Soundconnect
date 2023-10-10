<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Community;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Layout;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CommunityResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CommunityResource\RelationManagers;

class CommunityResource extends Resource
{
    protected static ?string $model = Community::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Models';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Community Details')
                    ->columns(2)
                    ->schema([
                        Select::make('owner_id')
                            ->relationship('owner', 'name')
                            ->required()
                            ->required(),
                        TextInput::make('name')
                            ->label('Community Name')
                            ->required(),
                        RichEditor::make('description')
                            ->label('Community Description')
                            ->required(),
                        FileUpload::make('header_image')
                            ->label('Community Image')
                            ->image()
                            ->directory('communities/header_images')
                            ->required(),
                        FileUpload::make('cover_image')
                            ->label('Cover Image')
                            ->image()
                            ->required()
                            ->directory('communities/cover_images'),

                    ])
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('handle_name')->sortable()->searchable(),
                TextColumn::make('created_at')->since(),
                TextColumn::make('owner.name')->sortable()->searchable(), 
                TextColumn::make('posts_count')->counts('posts')->sortable(),  
                //
            ])
            ->filters(
                [
                    // ...
                ],
                layout: Layout::AboveContent,
            )
            ->actions([
                Tables\Actions\ViewAction::make(),     
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListCommunities::route('/'),
            'create' => Pages\CreateCommunity::route('/create'),
            'edit' => Pages\EditCommunity::route('/{record}/edit'),
        ];
    }    
}
