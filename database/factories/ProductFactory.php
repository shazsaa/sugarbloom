<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'title' => $this->faker->sentence(2),
            'price' => $this->faker->randomFloat(2),
            'description' => $this->faker->sentence(20),
            'product_image' => $this->faker->imageUrl(150, 150, 'product', true, 'Faker'),
        ];
    }
}
