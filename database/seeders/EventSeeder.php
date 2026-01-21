<?php

namespace Database\Seeders;

use App\Models\MS_Event;
use App\Models\MS_Category;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $category = MS_Category::first();

        MS_Event::create([
            'title' => 'Laravel Workshop',
            'description' => 'Learn Laravel from scratch',
            'start_date' => now()->addDays(5),
            'end_date' => now()->addDays(6),
            'place' => 'IIT Campus',
            'capacity' => 50,
            'price' => 0,
            'is_free' => true,
            'status' => 'active',
            'category_id' => $category->id,
            'created_by' => 1,
        ]);

        MS_Event::create([
            'title' => 'AI Conference',
            'description' => 'Future of AI',
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(11),
            'place' => 'Tunis',
            'capacity' => 200,
            'price' => 100,
            'is_free' => false,
            'status' => 'active',
            'category_id' => $category->id,
            'created_by' => 1,
        ]);
    }
}
