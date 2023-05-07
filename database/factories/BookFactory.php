<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->sentence(4),
            'image'=> $this->faker->name(),
            'category_id' => random_int(1,10),
            'author_id' => random_int(1,10),
            'publisher_id' => random_int(1,10),
            'status' => 'Y'
        ];
    }
}
