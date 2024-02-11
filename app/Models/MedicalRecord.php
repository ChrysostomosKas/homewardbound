<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'medical_history',
        'medications',
        'allergies',
        'emergency_contact_number',
        'spaying_neutering_date',
        'behavioral_notes'
    ];

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function doctorAppointments(): HasMany
    {
        return $this->hasMany(DoctorAppointment::class);
    }
}
