<?php

namespace Database\Seeders;

use App\Models\LateLimit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LateLimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LateLimit::create([]);
    }
}
