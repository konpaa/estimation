<?php

namespace Tests\Feature\Http\Controllers;

use Tests\ControllerTestCase;

class AuthControllerTest extends ControllerTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs($this->user);
    }

    public function testRegisterUser()
    {
        $password = $this->faker->password;

        $this->post(route('register'), [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password,
            'password_confirmation' => $password
        ])->assertCreated();
    }

//    public function testNegativeRegisterUser()
//    {
//        $response = $this->withoutExceptionHandling()->post(route('register'), [
//            'name' => $this->faker->name,
//            'email' => $this->faker->name,
//            'password' => $this->faker->password(1, 3),
//            'password_confirmation' => $this->faker->password(1, 3)
//        ]);
//
//        $response->assertStatus(302);
//
//        $response->assertJsonValidationErrors(['email', 'password', 'password_confirmation']);
//    }

    public function testLoginUser()
    {
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        $response->assertOk();

        $response->assertJsonStructure(['token']);
    }

    public function testNegativeLoginUser()
    {
        $response = $this->post(route('login'), [
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ]);

        $response->assertUnauthorized();
    }

    public function testLogout()
    {
        $response = $this->post(route('logout'));

        $response->assertOk();
        $response->json(['message']);
    }
}
