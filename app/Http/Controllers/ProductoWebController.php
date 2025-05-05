<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductoWebController extends Controller
{
    public function mostrar($id)
    {
        $producto = Product::findOrFail($id); // usa 'id', no 'product_id'
        return view('detalle_producto', compact('producto'));
    }
    
}
