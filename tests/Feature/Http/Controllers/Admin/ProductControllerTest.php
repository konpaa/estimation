<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Tests\ControllerTestCase;

class ProductControllerTest extends ControllerTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->admin);
    }

    public function testIndex()
    {
        $response = $this->get(route(
            'admin.products.index',
            ['user' => $this->user, 'category' => $this->category]
        ));

        $response->assertOk();
        $response->assertJsonStructure(['data', 'links']);
    }

    public function testNegativeIndex()
    {
        $this->post(route(
            'logout',
            ['user' => $this->user, 'category' => $this->category]
        ));

        $this->actingAs($this->user);
        $response = $this->get(route(
            'admin.products.index',
            ['user' => $this->user, 'category' => $this->category]
        ));

        $response->assertForbidden();
        $response->assertJsonStructure(['error']);
    }

    public function testStore()
    {
        $response = $this->post(route(
            'admin.products.store',
            ['user' => $this->user, 'category' => $this->category]
        ), [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price_currency' => 'EUR',
            'price' => $this->faker->randomNumber()
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('products', ['price_currency' => 'EUR']);
    }

    public function testShow()
    {
        $response = $this->get(route('admin.products.show', [
            'user' => $this->user,
            'product' => $this->user->products()->first(),
            'category' => $this->user->products()->first()->category
        ]));

        $response->assertOk();
        $response->assertJsonStructure(['data' => ['name', 'description', 'price_currency', 'price']]);
    }

    public function testUpdate()
    {
        $response = $this->put(route('admin.products.update', [
            'user' => $this->user,
            'product' => $this->user->products()->first(),
            'category' => $this->user->products()->first()->category
        ]), [
            'price_currency' => 'RUB',
        ]);

        $response->assertOk();
        $response->assertJsonStructure(['data' => ['name', 'description', 'price_currency', 'price']]);
        $this->assertDatabaseHas('products', ['price_currency' => 'RUB']);
    }

    public function testDestroy()
    {
        $this->delete(route('admin.products.destroy', [
            'user' => $this->user,
            'product' => $this->user->products()->first(),
            'category' => $this->user->products()->first()->category
        ]))
            ->assertJsonStructure(['status']);
    }
}
