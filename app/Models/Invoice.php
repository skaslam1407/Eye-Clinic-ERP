<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'patient_id',
        'doctor_id',
        'eye_test_charges',
        'eyeglass_charges',
        'medicine_charges',
        'total_amount',
        'payment_status',
        'invoice_date',
        'logo_path',
    ];

    protected function casts(): array
    {
        return [
            'eye_test_charges' => 'decimal:2',
            'eyeglass_charges' => 'decimal:2',
            'medicine_charges' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'invoice_date' => 'date',
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
