<?php

namespace Database\Seeders;

use App\Models\AllowedIp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\AllowedIpService;
use Illuminate\Support\Facades\Cache;

class AllowedIpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(AllowedIpService $service): void
    {
        Cache::forget('allowedIps');
        
        $ipAddress = [
            'ip_address' => '127.*.*.*'
        ];
        $service->create($ipAddress);
    }
}
