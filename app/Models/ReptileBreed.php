<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReptileBreed extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'reptile_breeds';
    protected $fillable = ['name_en, name_gr'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_en'
            ]
        ];
    }
}
