<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the user_information associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_information(): HasOne
    {
        return $this->hasOne(UserInformation::class, 'user_id');
    }

    /**
     * Get the referal_link associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function referal_link(): HasOne
    {
        return $this->hasOne(Referal::class, 'user_id');
    }

    /**
     * Get all of the comissions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comissions(): HasMany
    {
        return $this->hasMany(Comission::class, 'user_id');
    }

    /**
     * Get the total_comission associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function total_comission(): HasOne
    {
        return $this->hasOne(TotalComission::class, 'user_id');
    }
}
