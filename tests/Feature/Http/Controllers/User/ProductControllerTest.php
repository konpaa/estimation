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
        $response = $this->post(route('user.products.store'), [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'currency' => 'BYN',
            'value' => 50
        ]);

        $response->assertCreated();
        $response->assertJsonStructure(['data' => ['name', 'description']]);
    }

    public function testNegativeStorage()
    {
        $this->post(route('logout', $this->user));
        $this->actingAs($this->admin);

        $response = $this->post(route('user.products.store'), [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'currency' => 'BYN',
            'value' => 50
        ]);
        $response->assertForbidden();
    }

    public function testIndex()
    {
        $response = $this->get(route('user.products.index'));

        $response->assertJsonStructure(['data', 'links']);
    }

    public function testShow()
    {
        $response = $this->get(route('user.products.show', $this->product));

        $response->assertOk();
        $response->assertJsonStructure(['data' => ['name', 'description']]);
    }

    public function testUpdate()
    {
        $response = $this->put(route('user.products.update', $this->product), [
            'name' => 'test'
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('products', ['name' => 'test']);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('user.products.destroy', $this->product));
        $response->assertOk();

        $response->assertJsonStructure(['status']);
    }
}
