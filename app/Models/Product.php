<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['last_price_change'];

    public function getLastPriceChangeAttribute()
    {
        return $this->priceChanges->last();
    }

    public function productCategories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'product_product_categories');
    }

    public function priceChanges(): HasMany
    {
        return $this->hasMany(PriceChanges::class);
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(Size::class);
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class)->using(ColorProduct::class);
    }

    public function productImages(): hasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function feedbacks(): hasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function specifications(): BelongsToMany
    {
        return $this->BelongsToMany(Specification::class, 'specification_product');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }
}
