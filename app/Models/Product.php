<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nombre',
        'imagen',
        'tamano',
        'tipo_papel',
        'precio',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
