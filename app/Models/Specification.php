<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function specificationCategory(): BelongsTo
    {
        return $this->belongsTo(SpecificationCategory::class);
    }

    public function specificationValues(): HasMany
    {
        return $this->hasMany(SpecificationValue::class);
    }

    public function products(): BelongsToMany
    {
        return $this->BelongsToMany(Product::class, 'specification_product');
    }
}
