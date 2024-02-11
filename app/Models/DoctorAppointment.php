<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorAppointment extends Model
{
    use HasFactory;

    protected $table = 'doctor_appointments';

    protected $fillable = [
        'medical_record_id',
        'appointment_date',
        'reason',
        'location',
        'contact_number',
    ];

    public function medicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
