<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetHealth extends Model
{
    use HasFactory;

    protected $table = 'pet_healths';

    protected $fillable = [
        'bathed_at',
        'hair_condition',
        'last_vaccination',
        'teeth_condition',
        'pet_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'bathed_at' => 'date',
        'last_vaccination' => 'date'
    ];


    /**
     * Get the pet that owns the health record.
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
}
