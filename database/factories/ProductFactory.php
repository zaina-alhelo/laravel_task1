<?php

namespace Database\Factories;
use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;

/** 
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->paragraph(),

        ];
    }
}
