<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use App\Models\Community;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $usersCount = User::all()->count();
        $communitiesCount = Community::all()->count();
        $postsCount = Post::all()->count();
        return [
            Card::make('Total users on the platform', $usersCount),
            Card::make('Communities on the platform', $communitiesCount),
            Card::make('Posts on the platform', $postsCount),
                
        ];
    }
}
