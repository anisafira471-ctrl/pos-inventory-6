<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke tabel Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke tabel Supplier (Tambahkan ini agar error hilang)
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}