<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * Get the medicalRecord for the pet.
     */
    public function medicalRecord(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MedicalRecord::class);
    }

    /**
     * Get the appointments for the pet.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(DoctorAppointment::class);
    }

    /**
     * Get the user record for the pet.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the health record for the pet.
     */
    public function petHealth(): HasOne
    {
        return $this->hasOne(PetHealth::class);
    }
}
