<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plate;
use App\Models\PlateItem;
use App\Models\Dish;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all dishes
        $dishes = Dish::all();

        // Create 10 dummy orders
        for ($i = 0; $i < 10; $i++) {
            // Create a plate (order)
            $plate = Plate::create([
                'email' => 'customer' . ($i + 1) . '@example.com',
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'status' => $this->getRandomStatus(),
                'total_amount' => 0,
                'pickup_time' => Carbon::now()->addHours(rand(1, 4)),
                'payment_id' => 'PAY-' . uniqid()
            ]);

            // Add 2-4 random items to each order
            $totalAmount = 0;
            $numItems = rand(2, 4);
            
            for ($j = 0; $j < $numItems; $j++) {
                $dish = $dishes->random();
                $quantity = rand(1, 3);
                $price = $dish->price;
                $subtotal = $price * $quantity;
                $totalAmount += $subtotal;

                PlateItem::create([
                    'plate_id' => $plate->id,
                    'dish_id' => $dish->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'special_instructions' => rand(0, 1) ? 'Extra spicy please' : null
                ]);
            }

            // Update the total amount
            $plate->update(['total_amount' => $totalAmount]);
        }
    }

    private function getRandomStatus()
    {
        $statuses = ['paid', 'ready', 'collected'];
        return $statuses[array_rand($statuses)];
    }
}