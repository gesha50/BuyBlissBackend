<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function colorCategory(): BelongsTo
    {
        return $this->belongsTo(ColorCategory::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function priceChangeColors(): HasMany
    {
        return $this->hasMany(PriceChangeColor::class);
    }

    public function priceChangeColorsLast(): HasMany
    {
        return $this->hasMany(PriceChangeColor::class)->latest('id')->limit(1);
    }

}
