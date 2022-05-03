<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'author_id' => '1',
            'title' => $this->faker->word(),
            'body' => $this->faker->paragraph(),
            'slug' => $this->faker->word(),
            'active' => true
        ];
    }
}
