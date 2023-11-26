<?php

namespace App\Models;

use App\Enums\AdoptionAdStatus;
use App\Enums\PetCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptionAd extends Model
{
    use HasFactory;

    protected $table = 'adoption_ads';

    protected $fillable = [
        'title',
        'description',
        'age',
        'size',
        'color',
        'gender',
        'breed',
        'vaccination_status',
        'spaying_neutering_status',
        'health_condition',
        'location',
        'contact_phone_number',
        'contact_email',
    ];

    protected $casts = [
        'type_of_pet' => PetCategory::class,
        'status' => AdoptionAdStatus::class
    ];
}
