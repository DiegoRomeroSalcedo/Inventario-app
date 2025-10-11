<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'identification',
        'name',
        'phone',
        'email',
        'address',
        'created_by',
        'updated_by'
    ];

    // Relación con Usuario que actulizo el cliente
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
