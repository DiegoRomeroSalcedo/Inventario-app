<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\User;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtotal',
        'total_sale',
        'total_base',
        'total_iva',
        'total_discount',
        'received_amount',
        'change_amount',
        'payment_method',
        'client_id',
        'user_id',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'invoice_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
