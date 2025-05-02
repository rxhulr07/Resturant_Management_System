<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Support\Str;

class RestaurantDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Create categories if they don't exist
        $categories = [
            'Appetizers' => [
                'Bruschetta' => 'Toasted bread topped with tomatoes, garlic, and basil',
                'Calamari' => 'Crispy fried calamari served with marinara sauce',
                'Spinach Artichoke Dip' => 'Creamy spinach and artichoke dip served with tortilla chips'
            ],
            'Main Course' => [
                'Grilled Salmon' => 'Fresh Atlantic salmon grilled to perfection with lemon butter sauce',
                'Beef Tenderloin' => '8oz tenderloin steak with garlic mashed potatoes',
                'Chicken Alfredo' => 'Fettuccine pasta with grilled chicken in creamy alfredo sauce'
            ],
            'Desserts' => [
                'Chocolate Lava Cake' => 'Warm chocolate cake with a molten center, served with vanilla ice cream',
                'Tiramisu' => 'Classic Italian dessert with layers of coffee-soaked ladyfingers and mascarpone cream'
            ],
            'Beverages' => [
                'Fresh Lemonade' => 'House-made lemonade with mint',
                'Iced Tea' => 'Fresh brewed black tea with lemon'
            ],
            'Sides' => [
                'Garlic Mashed Potatoes' => 'Creamy mashed potatoes with roasted garlic',
                'Steamed Vegetables' => 'Seasonal vegetables steamed to perfection'
            ]
        ];

        foreach ($categories as $categoryName => $dishes) {
            // Check if category exists, if not create it
            $category = Category::firstOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName]
            );

            // Create dishes for this category
            foreach ($dishes as $dishName => $description) {
                // Check if dish exists, if not create it
                Dish::firstOrCreate(
                    [
                        'name' => $dishName,
                        'category_id' => $category->id
                    ],
                    [
                        'description' => $description,
                        'price' => $this->getRandomPrice($categoryName),
                        'is_available' => true
                    ]
                );
            }
        }
    }

    /**
     * Get a random price based on category
     */
    private function getRandomPrice($category): float
    {
        switch ($category) {
            case 'Appetizers':
                return rand(5, 15);
            case 'Main Course':
                return rand(15, 30);
            case 'Desserts':
                return rand(5, 10);
            case 'Beverages':
                return rand(2, 5);
            case 'Sides':
                return rand(3, 8);
            default:
                return rand(5, 20);
        }
    }
}
