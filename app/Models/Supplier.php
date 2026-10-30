<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    // Pastikan tiga kolom ini ada di dalam fillable Anda:
    protected $fillable = [
        'name', 
        'phone', 
        'address'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}