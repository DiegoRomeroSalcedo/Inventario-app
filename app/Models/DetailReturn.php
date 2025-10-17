<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReturn extends Model
{
    use HasFactory;

    protected $table = 'details_return';

    protected $fillable = [
        'sale_return_id',
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'total',
        'observation',
    ];

    public function saleReturn() 
    {
        return $this->belongsTo(SaleReturn::class, 'sale_return_id');
    }

    public function sale() 
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}
