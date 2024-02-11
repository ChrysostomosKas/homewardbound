<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'species',
        'breed',
        'age',
        'weight',
        'color',
        'special_needs',
        'user_id',
        'microchip_number'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'user_id']
            ]
        ];
    }

    public function medicalRecord(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MedicalRecord::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(DoctorAppointment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
