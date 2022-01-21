<?php

namespace Tests\Feature\Http\Controllers\User;

use Tests\ControllerTestCase;

class ProductControllerTest extends ControllerTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->product->user);
    }

    public function testStore()
    {
        $response = $this->post(route('users.products.store', $this->product->category), [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price_currency' => 'BYN',
            'price' => 50
        ]);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => ['name', 'description']]);
    }

    public function testNegativeStorage()
    {
        $this->post(route('logout', $this->user));
        $this->actingAs($this->admin);

        $response = $this->post(route('users.products.store', $this->product->category), [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price_currency' => 'BYN',
            'price' => 50
        ]);
        $response->assertForbidden();
    }

    public function testIndex()
    {
        $response = $this->get(route('users.products.index', [
            'user' => $this->product->user,
            'category' => $this->product->category
        ]));

        $response->assertJsonStructure(['data', 'links']);
    }

    public function testShow()
    {
        $response = $this->get(route(
            'users.products.show',
            ['product' => $this->product->id, 'category' => $this->product->category]
        ));

        $response->assertOk();
        $response->assertJsonStructure(['data' => ['name', 'description']]);
    }

    public function testUpdate()
    {
        $response = $this->put(route(
            'users.products.update',
            ['product' => $this->product, 'category' => $this->product->category]
        ), [
            'name' => 'test'
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('products', ['name' => 'test']);
    }

    public function testDestroy()
    {
        $response = $this->delete(route(
            'users.products.destroy',
            ['product' => $this->product, 'category' => $this->product->category]
        ));
        $response->assertOk();

        $response->assertJsonStructure(['status']);
    }

    public function testTime()
    {
        $response = $this->post(route('users.products.store', $this->product->category), [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price_currency' => 'BYN',
            'price' => 50,
            'created_at' => '2022-10-05'
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('products', ['created_at' => '2022-10-05']);
    }
}
