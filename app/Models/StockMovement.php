<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'type',
        'reason',
    ];

    protected function product (): HasOne {
        return $this->hasOne(Product::class);
    }

    protected function location (): HasOne {
        return $this->hasOne(Location::class);
    }
}
