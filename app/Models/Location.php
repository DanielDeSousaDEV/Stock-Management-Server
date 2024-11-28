<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'street_name',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city',
        'CEP',
    ];
}
