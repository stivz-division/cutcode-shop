<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<Brand>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->company(),
            // TODO 3rd lesson
            'thumbnail' => ''
        ];
    }
}
