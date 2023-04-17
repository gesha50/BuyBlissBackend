<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function priceChangeSizes(): HasMany
    {
        return $this->hasMany(PriceChangeSize::class);
    }

    public function priceChangeSizesLast(): HasMany
    {
        return $this->hasMany(PriceChangeSize::class)->latest('id')->limit(1);
    }
}
