<?php

namespace Tests;

use App\Models\Category;
use App\Models\Price;
use App\Models\Product;
use App\Models\User;

abstract class ControllerTestCase extends TestCase
{
    protected User $user;
    protected User $admin;
    protected Product $product;
    protected Price $price;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => 'qwerty',
            'role' => 'admin'
        ]);
        $product = Product::factory()->create();
        $user->products()->create($product->toArray());
        $category = Category::factory()->create();

        $this->admin = $admin;
        $this->user = $user;
        $this->product = $product;
        $this->category = $category;
    }
}
