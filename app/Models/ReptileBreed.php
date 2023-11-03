<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReptileBreed extends Model
{
    use HasFactory;

    protected $table = 'reptile_breeds';
    protected $fillable = ['name'];
}
