<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }
    public function mostrarEnWeb()
    {
        $products = Product::with('category')->get();
        return view('welcome', compact('products'));
    }
    public function mostrarDetalle($id)
    {
        $producto = Product::with('category')->findOrFail($id); 
        return view('web.detalle_producto', compact('producto'));
    }
        
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'nombre'            => 'required|string|max:255',
            'imagen'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tamano'            => 'required|string',
            'tipo_papel'        => 'required|string|max:255',
            'precio'            => 'required|numeric|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'nombre'            => 'required|string|max:255',
            'imagen'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tamano'            => 'required|string',
            'tipo_papel'        => 'required|string|max:255',
            'precio'            => 'required|numeric|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            if ($product->imagen) {
                Storage::disk('public')->delete($product->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Product $product)
    {
        if ($product->imagen) {
            Storage::disk('public')->delete($product->imagen);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
