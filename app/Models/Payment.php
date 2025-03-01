<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    /**
     * Get the total_comission that owns the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function total_comission(): BelongsTo
    {
        return $this->belongsTo(TotalComission::class, 'total_comission_id');
    }
}
