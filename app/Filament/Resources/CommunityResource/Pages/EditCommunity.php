<?php

namespace App\Filament\Resources\CommunityResource\Pages;

use App\Filament\Resources\CommunityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommunity extends EditRecord
{
    protected static string $resource = CommunityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
