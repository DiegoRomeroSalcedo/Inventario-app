<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cost',
        'retencion',
        'flete',
        'IVA',
        'cost_with_taxes',
        'utility',
        'price',
        'discount',
        'expiration_date',
        'price_with_discount',
        'rentability',
        'details',
        'unity_type',
        'unit_of_measure',
        'brand_id',
        'created_by',
        'updated_by'
    ];

    // Relación con Marca
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relacion con Stock
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    // Relación con Usuario que actualizó el producto
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
