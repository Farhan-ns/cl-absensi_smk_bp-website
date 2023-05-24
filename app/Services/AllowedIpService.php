<?php

namespace App\Services;

use App\Models\AllowedIp;
use Illuminate\Support\Facades\Cache;

class AllowedIpService {
    private $cacheKey = 'allowedIps';

    public function index() 
    {
        $allowedIps = Cache::rememberForever($this->cacheKey, function () {
            return AllowedIp::all();
        });

        return $allowedIps;
    }

    public function create($validated)
    {
        Cache::forget($this->cacheKey);

        $created = AllowedIp::create($validated);

        $this->cacheAllowedIps();

        return $created;
    }

    public function update($validated, $model)
    {
        Cache::forget($this->cacheKey);

        $model->update($validated);
        $model->save();

        $this->cacheAllowedIps();

        return $model;
    }

    public function destroy($model)
    {
        Cache::forget($this->cacheKey);

        $model->delete();

        $this->cacheAllowedIps();

        return $model;
    }

    private function cacheAllowedIps() 
    {
        $allowedIps = AllowedIp::all();

        Cache::forever($this->cacheKey, $allowedIps);
    }


}