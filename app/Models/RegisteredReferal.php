<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegisteredReferal extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];
    /**
     * Get the referal_link that owns the RegisteredLink
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referal_link(): BelongsTo
    {
        return $this->belongsTo(Referal::class, 'referal_link_id');
    }
}
