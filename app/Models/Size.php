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

    protected $appends = ['last_price_change_size'];

    public function getLastPriceChangeSizeAttribute()
    {
        return $this->priceChangeSizes->last();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function priceChangeSizes(): HasMany
    {
        return $this->hasMany(PriceChangeSize::class);
    }
}
