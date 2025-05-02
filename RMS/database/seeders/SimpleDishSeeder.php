<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Category;
use Illuminate\Support\Str;

class SimpleDishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // First, ensure we have at least one category
        $category = Category::firstOrCreate(
            ['slug' => 'main-course'],
            ['name' => 'Main Course']
        );

        // Create some dishes
        $dishes = [
            [
                'name' => 'Grilled Salmon',
                'description' => 'Fresh Atlantic salmon grilled to perfection with lemon butter sauce',
                'price' => 24.99,
                'category_id' => $category->id,
                'is_available' => true
            ],
            [
                'name' => 'Beef Tenderloin',
                'description' => '8oz tenderloin steak with garlic mashed potatoes',
                'price' => 29.99,
                'category_id' => $category->id,
                'is_available' => true
            ],
            [
                'name' => 'Chicken Alfredo',
                'description' => 'Fettuccine pasta with grilled chicken in creamy alfredo sauce',
                'price' => 18.99,
                'category_id' => $category->id,
                'is_available' => true
            ]
        ];

        foreach ($dishes as $dishData) {
            Dish::firstOrCreate(
                [
                    'name' => $dishData['name'],
                    'category_id' => $dishData['category_id']
                ],
                $dishData
            );
        }
    }
}
