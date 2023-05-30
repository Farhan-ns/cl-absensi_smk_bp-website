<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkin_time',
        'checkout_time',
        'subject',
        'class_grade',
        'day_id',
        'teacher_id',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class);
    }
}
