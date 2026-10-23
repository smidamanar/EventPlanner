<?php

namespace Database\Factories;

use App\Models\MS_Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MS_Category>
 */
class MS_CategoryFactory extends Factory
{
    protected $model = MS_Category::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
        ];
    }
}
