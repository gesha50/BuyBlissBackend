<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceChangeSize extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
}
