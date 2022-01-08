<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'price' => $this->faker->randomNumber(),
            'price_currency' => 'BYN',

            'user_id' => function () {
                return User::factory()->create()->id;
            },

            'category_id' => function () {
                return Category::factory()->create()->id;
            }
        ];
    }
}
