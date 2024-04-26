<?php

namespace App\Models;

use App\Enums\ReportRequestStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapMarker extends Model
{
    use HasFactory;

    protected $table = 'map_markers';
    protected $casts = [
        'image' => 'array',
        'status' => ReportRequestStatus::class,
    ];

    protected $fillable = [
        'lat',
        'lng',
        'contact_phone_number',
        'status',
        'image'
    ];
}
