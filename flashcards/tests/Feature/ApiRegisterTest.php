<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $seed = true;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {
        $password = $this->faker->password();
        $email = $this->faker->email();

        $response = $this->post( '/api/user', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertStatus( 200 );
    }
}