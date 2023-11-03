<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmphibianBreed extends Model
{
    use HasFactory;

    protected $table = 'amphibian_breeds';
    protected $fillable = ['name'];
}
