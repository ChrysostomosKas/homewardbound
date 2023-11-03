<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorseBreed extends Model
{
    use HasFactory;

    protected $table = 'horse_breeds';
    protected $fillable = ['name'];
}
