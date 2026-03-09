<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class EyeCheckup extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'vision_test',
        'right_eye_vision',
        'left_eye_vision',
        'lens_power',
        'sph',
        'cyl',
        'axis',
        'eye_condition',
        'doctor_notes',
        'prescription',
        'recommended_glasses',
        'follow_up_date',
    ];

    protected function casts(): array
    {
        return [
            'follow_up_date' => 'date',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
