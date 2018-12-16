<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WallControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Ensure user can retrieve posts
     *
     * @return void
     */
    public function testItCanRetrievePosts()
    {
        $posts = factory(\App\Post::class, 3)->create();

        $response = $this->withoutMiddleware()->json(
            'GET',
            'api/wall'
        );

        //dd($response);
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'posts',
            ]);
    }

    /**
     * Ensure user can create post
     *
     * @return void
     */
    public function testItCanCreatePost()
    {
        $user = factory(\App\User::class)->create();
        $post = factory(\App\Post::class)->make([
            'user_id' => null,
        ])->toArray();

        $headers = [
            'Authorization' => 'Bearer '.auth()->tokenById($user->id),
        ];

        $response = $this->json(
            'POST',
            'api/wall',
            $post,
            $headers
        );

        //dd($response);
        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'post',
            ]);
    }

    /**
     * Ensure non-user cannot create post
     *
     * @return void
     */
    public function testItCannotCreatePost()
    {
        $post = factory(\App\Post::class)->make([
            'user_id' => null,
        ])->toArray();

        $response = $this->json(
            'POST',
            'api/wall',
            $post
        );

        //dd($response);
        $response
            ->assertStatus(401);
    }
}
