<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferalAccess extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    /**
     * Get the referal that owns the ReferalAccess
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referal_link(): BelongsTo
    {
        return $this->belongsTo(Referal::class, 'referal_id');
    }
}
