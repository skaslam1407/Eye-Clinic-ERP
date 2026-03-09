<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'patient_code',
        'name',
        'age',
        'gender',
        'phone',
        'address',
        'email',
        'eye_problem',
        'registration_date',
    ];

    protected function casts(): array
    {
        return [
            'registration_date' => 'date',
        ];
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function eyeglassOrders(): HasMany
    {
        return $this->hasMany(EyeglassOrder::class);
    }

    public function eyeCheckups(): HasMany
    {
        return $this->hasMany(EyeCheckup::class);
    }
}
