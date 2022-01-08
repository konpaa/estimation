<?php

namespace App\Services;

use App\DataTransferObject\FilterProductDto;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class StatisticService
{
    public function getResponse(FilterProductDto $filters): array
    {
        $query = $this->timeFilter(
            request()->user()->products()->getQuery(),
            $filters->getStartAt(),
            $filters->getEndAt()
        );

        if ($filters->getCategoryName()) {
            $query = $this->nameFilter($query, $filters->getCategoryName());
        }

        return $this->getResult($query->get());
    }

    private function timeFilter(Builder $builder, string $start_at, string $end_at): Builder
    {
        return $builder->whereBetween('created_at', [$start_at, $end_at]);
    }

    private function nameFilter(Builder $builder, string $category_name): Builder
    {
        return $builder->whereRelation('category', 'name', $category_name);
    }

    private function getResult(Collection $collection): array
    {
        return $collection->reduce(function (array $acc, Product $product) {
            $category = $product->category->name;
            $costProduct = $product->price->getValue();

            if (key_exists($category, $acc)) {
                $acc[$category]['value'] += $costProduct;
                $acc[$category]['count_product'] += 1;
            } else {
                $acc[$category]['value'] = $costProduct;
                $acc[$category]['count_product'] = 1;
            }

            $acc['total_cost']['value'] += $costProduct;

            return $acc;
        }, ['total_cost' => ['value' => 0]]);
    }
}
