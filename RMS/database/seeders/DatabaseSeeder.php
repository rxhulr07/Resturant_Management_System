<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Order;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            SimpleDishSeeder::class,
        ]);

        // Create categories
        $categories = [
            ['name' => 'Pizza', 'slug' => 'pizza'],
            ['name' => 'Burgers', 'slug' => 'burgers'],
            ['name' => 'Pasta', 'slug' => 'pasta'],
            ['name' => 'Salads', 'slug' => 'salads'],
            ['name' => 'Desserts', 'slug' => 'desserts'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create sample dishes
        $dishes = [
            [
                'name' => 'Margherita Pizza',
                'description' => 'Classic tomato sauce, mozzarella, and basil',
                'price' => 12.99,
                'category_id' => 1,
                'is_available' => true
            ],
            [
                'name' => 'Chicken Burger',
                'description' => 'Grilled chicken breast with lettuce and mayo',
                'price' => 8.99,
                'category_id' => 2,
                'is_available' => true
            ],
            [
                'name' => 'Spaghetti Carbonara',
                'description' => 'Creamy pasta with bacon and parmesan',
                'price' => 13.99,
                'category_id' => 3,
                'is_available' => true
            ],
        ];

        foreach ($dishes as $dish) {
            Dish::create($dish);
        }

        // Create sample orders
        $orders = [
            [
                'order_number' => 'ORD-5NDIKFCY',
                'email' => 'customer1@example.com',
                'status' => 'ready',
                'total_amount' => 25.98,
                'pickup_time' => Carbon::now()->addHours(2),
                'created_at' => Carbon::now()->subHours(1)
            ],
            [
                'order_number' => 'ORD-SVCHILS',
                'email' => 'customer2@example.com',
                'status' => 'collected',
                'total_amount' => 13.99,
                'pickup_time' => Carbon::now()->addHours(1),
                'created_at' => Carbon::now()->subMinutes(30)
            ],
            [
                'order_number' => 'ORD-KDE6B9LF',
                'email' => 'customer3@example.com',
                'status' => 'confirmed',
                'total_amount' => 8.99,
                'pickup_time' => Carbon::now()->addHours(3),
                'created_at' => Carbon::now()
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
