<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_return_id',
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'total',
        'observation',
    ];
}
