<?php

namespace Tests;

use App\Models\User;

abstract class ControllerTestCase extends TestCase
{
    protected User $user;
    protected User $admin;

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

        $this->admin = $admin;
        $this->user = $user;
    }
}
