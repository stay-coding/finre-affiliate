<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Referal extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    /**
     * Get the user that owns the Referal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all of the referal_access for the Referal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referal_access(): HasMany
    {
        return $this->hasMany(ReferalAccess::class, 'referal_id');
    }

    /**
     * Get all of the registered_links for the Referal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registered_referals(): HasMany
    {
        return $this->hasMany(RegisteredReferal::class, 'referal_id');
    }
}
