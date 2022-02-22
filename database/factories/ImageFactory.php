<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'size' => $this->faker->randomDigit,
            'extension' => $this->faker->randomElement(['png', 'jpg', 'jpeg', 'webp']),
            'path' =>  $this->faker->imageUrl(1900, 1200, 'technojs.com'),
        ];
    }
}
