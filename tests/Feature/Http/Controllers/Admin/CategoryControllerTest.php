<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Validation\ValidationException;
use Tests\ControllerTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends ControllerTestCase
{
    use RefreshDatabase;

    function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->admin);
    }

    public function testStore()
    {
        $this->post(route('admin.categories.store'), [
            'name' => 'Entertainment',
            'description' => 'Film, show or other performances or activities that entertain people.'
        ])->assertCreated();

        $this->assertDatabaseHas('categories', ['name' => 'Entertainment']);
    }

    public function testIndex()
    {
        $response = $this->get(route('admin.categories.index'))->assertOk();

        $response->assertJsonStructure(['data', 'links']);
    }

    public function testShow()
    {
        $response = $this->get(route('admin.categories.show', $this->category))->assertOk();

        $response->assertJsonStructure(['data' => ['id', 'name', 'description']]);
    }

    public function testUpdate()
    {
        $this->put(route('admin.categories.update', $this->category), [
            'name' => 'Food'
        ])->assertOk();

        $this->assertDatabaseHas('categories', ['name' => 'Food']);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('admin.categories.destroy', $this->category))->assertOk();

        $response->assertJson(['status' => 'success']);
    }

    public function testNegativeDestroy()
    {
        $response = $this
            ->withExceptionHandling()
            ->deleteJson(route('admin.categories.destroy', $this->product->category))
            ->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => ['message' => ['Category have products']
            ]]);
    }

    public function testUniqueName()
    {
        $response = $this
            ->withExceptionHandling()
            ->postJson(route('admin.categories.store'), [
                'name' => $this->category->name,
                'description' => $this->category->description,
            ])->assertStatus(422);

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => ['name' => ['The name has already been taken.']
            ]]);
    }
}
