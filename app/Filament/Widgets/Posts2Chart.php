<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\LineChartWidget;

class Posts2Chart extends LineChartWidget
{
    protected static ?string $heading = 'Posts Trend';
    public ?string $filter = 'year';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '300px';
    protected static ?int $sort = 2;
    

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        if($activeFilter == "today")
        {
            $data = Trend::model(Post::class)
            ->between(
                start: now()->startOfDay(),
                end: now()->endOfDay(),
            )
            ->perHour()
            ->count();
        }
        if($activeFilter == "week")
        {
            $data = Trend::model(Post::class)
            ->between(
                start: now()->startOfWeek(),
                end: now()->endOfWeek(),
            )
            ->perDay()
            ->count();
        }
        if($activeFilter == "month")
        {
            $data = Trend::model(Post::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();
        }
        if($activeFilter == "year")
        {
            $data = Trend::model(Post::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        }
        
 
    return [
        'datasets' => [
            [
                'label' => 'New Posts',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
    }
}
