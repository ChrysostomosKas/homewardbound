<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'appointment_date',
        'reason',
        'diagnosis',
        'prescription',
    ];

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
