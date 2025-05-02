<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create the default admin user
        AdminUser::firstOrCreate(
            ['email' => 'admin@yummy.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // Create an additional admin user
        AdminUser::firstOrCreate(
            ['email' => 'admin2@yummy.com'],
            [
                'name' => 'Admin 2',
                'password' => Hash::make('admin123'),
            ]
        );
    }
} 