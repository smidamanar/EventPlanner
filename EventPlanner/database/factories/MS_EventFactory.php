<?php

namespace Database\Factories;

use App\Models\MS_Category;
use App\Models\MS_Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MS_Event>
 */
class MS_EventFactory extends Factory
{
    protected $model = MS_Event::class;

    public function definition(): array
    {
        $startDate = now()->addDays(7);

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'start_date' => $startDate,
            'end_date' => $startDate->copy()->addHours(2),
            'place' => fake()->city(),
            'price' => null,
            'is_free' => true,
            'capacity' => fake()->numberBetween(5, 100),
            'status' => 'active',
            'category_id' => MS_Category::factory(),
            'created_by' => User::factory(),
        ];
    }
}
