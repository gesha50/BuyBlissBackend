<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Specification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function specificationCategory(): BelongsTo
    {
        return $this->belongsTo(SpecificationCategory::class);
    }
}
