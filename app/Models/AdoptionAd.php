<?php

namespace App\Models;

use App\Enums\AdoptionAdStatus;
use App\Enums\PetCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'base_image'
    ];

    protected $casts = [
        'type_of_pet' => PetCategory::class,
        'status' => AdoptionAdStatus::class,
        'base_image' => 'array'
    ];

    /*
     *
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
