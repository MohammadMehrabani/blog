<?php

namespace Database\Seeders;

use Src\Post\Models\Post;
use Src\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'firstname' => 'Test',
            'lastname' => 'User',
            'mobile' => '09121111111',
        ]);

        Post::factory(10)->create([
            'user_id' => $user->id
        ]);

        User::factory(10)->create()->each(function (User $user) {
            Post::factory(rand(1, 10))->create([
                'user_id' => $user->id
            ]);
        });
    }
}
