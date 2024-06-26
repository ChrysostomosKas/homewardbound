<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable, HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'city',
        'email',
        'password',
        'provider',
        'provider_id',
        'provider_token',
        'username',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    /**
     * The attributes that should be cast.
     *
     * @param $query
     * @param $val
     *
     * @return mixed
     */
    public function scopeSearch($query, $val): mixed
    {
        return $query
            ->where('first_name', 'like', '%' . $val . '%')
            ->orwhere('last_name', 'like', '%' . $val . '%')
            ->orwhere('email', 'like', '%' . $val . '%');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['first_name', 'last_name']
            ]
        ];
    }

    /**
     * Get the likes for the users.
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(AdoptionAd::class);
    }

    /**
     * Get the pets for the users.
     */
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    /**
     * Get the adoptionAds for the users.
     */
    public function adoptionAds(): HasMany
    {
        return $this->hasMany(AdoptionAd::class);
    }

    /**
     * Get the adoptionInterests for the users.
     */
    public function adoptionInterests(): HasMany
    {
        return $this->hasMany(AdoptionInterest::class);
    }
}
