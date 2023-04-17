<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceChangeColor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }
}
