<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StockMovements extends Model
{
    protected $fillable = [
        'products_id',
        'locations_id',
        'quantity',
        'type',
        'reason',
    ];

    protected function product (): HasOne {
        return $this->hasOne(Products::class);
    }

    protected function location (): HasOne {
        return $this->hasOne(Locations::class);
    }
}
