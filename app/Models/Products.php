<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Products extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'minimum_quantity',
    ];

    public function category (): HasOne {
        return $this->hasOne(Categories::class);
    }
}
