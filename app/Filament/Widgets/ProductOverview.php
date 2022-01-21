<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\LineChartWidget as Widget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class ProductOverview extends Widget
{
    protected function getHeading(): string
    {
        return 'Product bought';
    }

    protected function getData(): array
    {
        $data = $this->getModel();
        return [
            'datasets' => [
                [
                    'label' => 'Purchases',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getModel()
    {
        return Trend::query(
            Product::query()->whereRelation('user', 'email', '=', 'pavelkonoplyanikov@yandex.by')
        )
            ->between(
                start: now()->startOf('month'),
                end: now()->endOf('week', Carbon::FRIDAY),
            )
            ->perDay()
            ->sum('price');
    }
}
