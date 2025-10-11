<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_by', 'updated_by'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
