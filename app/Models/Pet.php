<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'user_id'
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
}
