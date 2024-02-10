<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapMarker extends Model
{
    use HasFactory;
    protected $table = 'map_markers';
    protected $casts = [
        'image' => 'array',
    ];

    protected $fillable = [
        'lat',
        'lng',
        'contact_phone_number',
        'image'
    ];
}
