<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DogBreed extends Model
{
    use HasFactory;

    protected $table = 'dog_breeds';
    protected $fillable = ['name'];

}
