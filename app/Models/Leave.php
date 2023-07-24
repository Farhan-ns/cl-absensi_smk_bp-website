<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_type',
        'absence_document',
        'absence_note',
        'approval_status',
        'from_date',
        'to_date',
        'absence_reason',
        'teacher_id',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class)->withTrashed();
    }

    public function attendance(): BelongsTo
    {
        return $this->belongsTo(Attendance::class);
    }
}
