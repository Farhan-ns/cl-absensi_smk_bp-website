<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (config('app.debug')) {
            Teacher::create([
                'name' => 'Mr. Dummy Teacher',
                'birthdate' => '1991-01-01',
                'email' => 'teacher@gmail.com',
                'phone' => '0895456701232',
                'address' => 'Jl. Bahura Mazda No. 123',
                'password' => bcrypt('pass123'),
            ]);
        }
    }
}
