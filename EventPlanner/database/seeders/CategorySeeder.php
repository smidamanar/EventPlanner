<?php

namespace Database\Seeders;

use App\Models\MS_Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Technology',
            'Business',
            'Health',
            'Education',
            'Sports',
        ];

        foreach ($categories as $name) {
            MS_Category::create(['name' => $name]);
        }
    }
}
