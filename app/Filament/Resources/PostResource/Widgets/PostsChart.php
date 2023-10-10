<?php

namespace App\Filament\Resources\PostResource\Widgets;

use Filament\Widgets\BarChartWidget;

class PostsChart extends BarChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }
}
