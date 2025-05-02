<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Category;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appetizers = Category::where('slug', 'appetizers')->first();
        $mainCourse = Category::where('slug', 'main-course')->first();
        $desserts = Category::where('slug', 'desserts')->first();
        $beverages = Category::where('slug', 'beverages')->first();
        $sides = Category::where('slug', 'sides')->first();

        // Appetizers
        if ($appetizers) {
            Dish::create([
                'name' => 'Bruschetta',
                'description' => 'Toasted bread topped with tomatoes, garlic, and basil',
                'price' => 8.99,
                'category_id' => $appetizers->id,
                'is_available' => true
            ]);

            Dish::create([
                'name' => 'Calamari',
                'description' => 'Crispy fried calamari served with marinara sauce',
                'price' => 12.99,
                'category_id' => $appetizers->id,
                'is_available' => true
            ]);

            Dish::create([
                'name' => 'Spinach Artichoke Dip',
                'description' => 'Creamy spinach and artichoke dip served with tortilla chips',
                'price' => 10.99,
                'category_id' => $appetizers->id,
                'is_available' => true
            ]);
        }

        // Main Course
        if ($mainCourse) {
            Dish::create([
                'name' => 'Grilled Salmon',
                'description' => 'Fresh Atlantic salmon grilled to perfection with lemon butter sauce',
                'price' => 24.99,
                'category_id' => $mainCourse->id,
                'is_available' => true
            ]);

            Dish::create([
                'name' => 'Beef Tenderloin',
                'description' => '8oz tenderloin steak with garlic mashed potatoes',
                'price' => 29.99,
                'category_id' => $mainCourse->id,
                'is_available' => true
            ]);

            Dish::create([
                'name' => 'Chicken Alfredo',
                'description' => 'Fettuccine pasta with grilled chicken in creamy alfredo sauce',
                'price' => 18.99,
                'category_id' => $mainCourse->id,
                'is_available' => true
            ]);
        }

        // Desserts
        if ($desserts) {
            Dish::create([
                'name' => 'Chocolate Lava Cake',
                'description' => 'Warm chocolate cake with a molten center, served with vanilla ice cream',
                'price' => 8.99,
                'category_id' => $desserts->id,
                'is_available' => true
            ]);

            Dish::create([
                'name' => 'Tiramisu',
                'description' => 'Classic Italian dessert with layers of coffee-soaked ladyfingers and mascarpone cream',
                'price' => 7.99,
                'category_id' => $desserts->id,
                'is_available' => true
            ]);
        }

        // Beverages
        if ($beverages) {
            Dish::create([
                'name' => 'Fresh Lemonade',
                'description' => 'House-made lemonade with mint',
                'price' => 3.99,
                'category_id' => $beverages->id,
                'is_available' => true
            ]);

            Dish::create([
                'name' => 'Iced Tea',
                'description' => 'Fresh brewed black tea with lemon',
                'price' => 2.99,
                'category_id' => $beverages->id,
                'is_available' => true
            ]);
        }

        // Sides
        if ($sides) {
            Dish::create([
                'name' => 'Garlic Mashed Potatoes',
                'description' => 'Creamy mashed potatoes with roasted garlic',
                'price' => 5.99,
                'category_id' => $sides->id,
                'is_available' => true
            ]);

            Dish::create([
                'name' => 'Steamed Vegetables',
                'description' => 'Seasonal vegetables steamed to perfection',
                'price' => 4.99,
                'category_id' => $sides->id,
                'is_available' => true
            ]);
        }
    }
} 