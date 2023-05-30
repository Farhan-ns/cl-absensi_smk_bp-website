<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = ['name', 'password', 'birthdate', 'phone', 'email', 'address'];

    protected $hidden = ['password'];

    public function schedules(): HasMany
    {
        return $this->hasMany(TeacherSchedule::class);
    }
}
