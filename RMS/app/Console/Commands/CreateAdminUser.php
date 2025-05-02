<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {name} {email} {password}';
    protected $description = 'Create a new admin user';

    public function handle()
    {
        $admin = AdminUser::create([
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
        ]);

        $this->info('Admin user created successfully!');
        $this->table(
            ['Name', 'Email'],
            [[$admin->name, $admin->email]]
        );
    }
} 