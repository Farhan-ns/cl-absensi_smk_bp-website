<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@test.com',
            'name' => 'Super Admin',
            'password' => bcrypt('admin123'),
            'user_role_id' => 2,
        ]);
    }
}
