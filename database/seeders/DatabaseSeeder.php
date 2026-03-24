<?php

namespace Database\Seeders;

//use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'avatar' => 'images/demo/avatars/3.png',
            'role' => 1,
        ]);

        $users = \App\Models\User::factory(10)->create();

        $topics = \App\Models\Topic::factory(10)->create();

        $posts = \App\Models\Post::factory(30)->create();

    }
}
