<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Topic;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->paragraph(),
            'user_id' => User::inRandomOrder()->first()->id,
            'topic_id' => Topic::inRandomOrder()->first()->id,
            'picture' => 'images/demo/post_img/' . fake()->numberBetween(1, 10) . '.jpg',
        ];
    }
}
