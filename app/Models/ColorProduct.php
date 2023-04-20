<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ColorProduct extends Pivot
{
    use HasFactory;

    protected $guarded = [];

}
