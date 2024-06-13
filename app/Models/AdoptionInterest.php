<?php

namespace App\Models;

use App\Enums\AdoptionAdStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdoptionInterest extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'adoption_interests';

    protected $casts = [
        'status' => AdoptionAdStatus::class
    ];

    /*
     * Get the user for the adoptionInterest.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
     * Get the adoptionAd for the adoptionInterest.
     */
    public function adoptionAd(): BelongsTo
    {
        return $this->belongsTo(AdoptionAd::class);
    }
}
