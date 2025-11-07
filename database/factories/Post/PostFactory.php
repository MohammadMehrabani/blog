<?php

namespace Database\Factories\Post;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Post\Models\Post;
use Src\User\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Src\Post\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(2),
            'body' => fake()->paragraph(5),
            'views' => rand(0, 50),
            'user_id' => User::factory(),
        ];
    }
}
