<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RabbitBreed extends Model
{
    use HasFactory;

    protected $table = 'rabbit_breeds';
    protected $fillable = ['name'];
}
