<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'nombre', 'imagen'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
