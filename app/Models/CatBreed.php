<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatBreed extends Model
{
    use HasFactory;

    protected $table = 'cat_breeds';
    protected $fillable = ['name'];
}
