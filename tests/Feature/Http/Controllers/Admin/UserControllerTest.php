<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Tests\ControllerTestCase;

class UserControllerTest extends ControllerTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->admin);
    }

    public function testIndex()
    {
        $response = $this->get(route('admin.users.index'));

        $response->assertOk();
        $response->assertJsonStructure(['data', 'links']);
    }

    public function testNegativeIndex()
    {
        $this->post(route('logout'));

        $this->actingAs($this->user);
        $response = $this->get(route('admin.users.index'));

        $response->assertForbidden();
        $response->assertJsonStructure(['error']);
    }

    public function testStore()
    {
        $response = $this->post(route('admin.users.store'), [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
            'role' => 'user'
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function testShow()
    {
        $response = $this->get(route('admin.users.show', ['user' => $this->user]));
        $response->assertOk();
        $response->assertJsonStructure(['data' => ['name', 'email']]);
    }

    public function testUpdate()
    {
        $response = $this->put(route('admin.users.update', $this->user), [
            'name' => 'test',
            'email' => 'test@example.com',
            'role' => 'user'
        ]);

        $response->assertOk();
        $response->assertJsonStructure(['data' => ['name', 'email']]);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function testDestroy()
    {
        $this->delete(route('admin.users.destroy', $this->user))->assertJsonStructure(['status']);
    }
}
