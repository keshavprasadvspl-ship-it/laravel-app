<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sdinternational.com'],
            [
                'name' => 'SD International Admin',
                'password' => Hash::make('admin123456'),
                'email_verified_at' => now(),
            ]
        );
    }
}
