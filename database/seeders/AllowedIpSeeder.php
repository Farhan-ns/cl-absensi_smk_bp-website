<?php

namespace Database\Seeders;

use App\Models\AllowedIp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllowedIpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (config('app.debug')) {
            AllowedIp::create([
                'ip_address' => '127.*.*.*'
            ]);
        }
    }
}
