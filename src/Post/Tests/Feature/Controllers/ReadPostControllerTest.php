<?php

namespace Src\Post\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\Attributes\Test;
use Src\Post\Models\Post;
use Src\SharedKernel\Tests\HttpTestCase;
use Src\User\Models\User;
use Symfony\Component\HttpFoundation\Response;

class ReadPostControllerTest extends HttpTestCase
{
    use DatabaseMigrations;

    #[Test]
    public function it_increments_view_count_once_per_ip_per_day()
    {
        $user = User::factory()->create([
            'total_post_views' => 0
        ]);

        $post = Post::factory()->create([
            'user_id' => $user->id,
            'views' => 0
        ]);

        Cache::flush();

        $this->get(route('posts.read', ['id' => $post->id]))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->actingAs($user);

        $this->get(route('posts.read', ['id' => $post->id]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    'id' => $post->id,
                    'views' => 1,
                    'user' => [
                        'id' => $user->id,
                        'total_post_views' => 1
                    ],
                ],
            ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'views' => 1,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'total_post_views' => 1,
        ]);

        $this->actingAs($user);

        $this->get(route('posts.read', ['id' => $post->id]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    'id' => $post->id,
                    'views' => 1,
                    'user' => [
                        'id' => $user->id,
                        'total_post_views' => 1
                    ],
                ],
            ]);

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
            'views' => 2,
        ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'total_post_views' => 2,
        ]);

        $this->travel(25)->hours();

        $this->actingAs($user);

        $this->get(route('posts.read', ['id' => $post->id]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'data' => [
                    'id' => $post->id,
                    'views' => 2,
                    'user' => [
                        'id' => $user->id,
                        'total_post_views' => 2
                    ],
                ],
            ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'views' => 2,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'total_post_views' => 2,
        ]);
    }
}
