<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirdBreed extends Model
{
    use HasFactory;

    protected $table = 'bird_breeds';
    protected $fillable = ['name'];
}
