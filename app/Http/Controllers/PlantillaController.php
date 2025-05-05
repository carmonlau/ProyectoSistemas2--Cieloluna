<?php

namespace App\Http\Controllers;

use App\Models\Plantilla;
use App\Models\Product;
use Illuminate\Http\Request;

class PlantillaController extends Controller
{
    public function index()
    {
        $plantillas = Plantilla::with('product')->get();
        return view('plantillas.index', compact('plantillas'));
    }

    public function create()
    {
        $products = Product::all();
        return view('plantillas.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'nombre' => 'required',
            'imagen' => 'required|image'
        ]);

        $imagePath = $request->file('imagen')->store('images/plantillas', 'public');
        
        Plantilla::create([
            'nombre' => $request->nombre, // Cambiado de 'name' a 'nombre'
            'product_id' => $request->product_id,
            'imagen' => $imagePath,
        ]);
        
        return redirect()->route('plantillas.index');
    }

    public function update(Request $request, Plantilla $plantilla)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'nombre' => 'required',
            'imagen' => 'nullable|image'
        ]);

        $imagePath = $request->hasFile('imagen') 
            ? $request->file('imagen')->store('images/plantillas', 'public') 
            : $plantilla->imagen;
            
        $plantilla->update([
            'nombre' => $request->nombre, // Cambiado de 'name' a 'nombre'
            'product_id' => $request->product_id,
            'imagen' => $imagePath,
        ]);
        
        return redirect()->route('plantillas.index');
    }

    public function destroy(Plantilla $plantilla)
    {
        $plantilla->delete();
        return redirect()->route('plantillas.index');
    }
}
