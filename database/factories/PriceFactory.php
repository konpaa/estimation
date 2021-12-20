<?php

namespace Database\Factories;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PriceFactory extends Factory
{
    protected $model = Price::class;

    public function definition(): array
    {
        return [
            'currency' => 'BYN',
            'value' => $this->faker->randomDigit(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'product_id' => function () {
                return Product::factory()->create()->id;
            },
        ];
    }
}
