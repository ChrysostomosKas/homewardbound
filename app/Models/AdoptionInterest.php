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
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
