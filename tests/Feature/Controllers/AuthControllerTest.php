<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Ensure user can be registered
     *
     * @return void
     */
    public function testItCanRegister()
    {
        $user = factory(\App\User::class)->make();

        $params = array_merge($user->toArray(), [
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response = $this->json(
            'POST',
            'api/auth/register',
            $params
        );

        //dd($response);
        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'user',
            ]);
    }

    /**
     * Ensure user can login
     *
     * @return void
     */
    public function testItCanLogin()
    {
        $user = factory(\App\User::class)->create();

        $params = [
            'email' => $user->email,
            'password' => 'longsecret',
        ];

        $response = $this->json(
            'POST',
            'api/auth/login',
            $params
        );

        //dd($response);
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);
    }

    /**
     * Ensure user can logout
     *
     * @return void
     */
    public function testItCanLogout()
    {
        $user = factory(\App\User::class)->create();
        $token = auth()->tokenById($user->id);

        $headers = [
            'Authorization' => 'Bearer '.$token,
        ];

        $response = $this->json(
            'POST',
            'api/auth/logout',
            [],
            $headers
        );

        //dd($response);
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'Successfully logged out',
            ]);
    }

    /**
     * Ensure user can refresh token
     *
     * @return void
     */
    public function testItCanRefreshToken()
    {
        $user = factory(\App\User::class)->create();

        $headers = [
            'Authorization' => 'Bearer '.auth()->tokenById($user->id),
        ];

        $response = $this->json(
            'POST',
            'api/auth/refresh',
            [],
            $headers
        );

        //dd($response);
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);
    }
}
