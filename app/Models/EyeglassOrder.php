<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class EyeglassOrder extends Model
{
    protected $fillable = [
        'patient_id',
        'eyeglass_type',
        'lens_power',
        'order_date',
        'delivery_date',
        'delivery_status',
    ];

    protected function casts(): array
    {
        return [
            'order_date' => 'date',
            'delivery_date' => 'date',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
