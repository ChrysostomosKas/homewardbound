<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function doctorAppointments()
    {
        return $this->hasMany(DoctorAppointment::class);
    }
}
