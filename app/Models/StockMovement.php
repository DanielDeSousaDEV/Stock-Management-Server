<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'type',
        'reason',
        'product_id',
        'location_id'
    ];

    public function product (): BelongsTo {
        return $this->belongsTo(Product::class);
    }

    public function location (): BelongsTo {
        return $this->belongsTo(Location::class);
    }
}
