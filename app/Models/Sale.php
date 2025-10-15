<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use App\Models\Product;

class Sale extends Model
{
    use HasFactory;


    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'unity_price',
        'price_with_discount',
        'sale_amount',
        'discount',
        'created_by',
        'updated_by',
    ];

    public function product() 
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function invoices()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
