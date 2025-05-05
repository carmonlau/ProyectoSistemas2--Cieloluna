<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        $inventarios = Inventario::orderBy('created_at', 'desc')
                        ->paginate(10);
        
        return view('inventario.index', compact('inventarios'));
    }

    public function create()
    {
        return view('inventario.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad_disponible' => 'required|integer|min:0',
            'cantidad_minima' => 'required|integer|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            'cantidad_por_paquete' => 'nullable|integer|min:1',
            'precio_por_paquete' => 'nullable|numeric|min:0',
            'ubicacion' => 'nullable|string|max:100',
            'proveedor' => 'nullable|string|max:255',
            'fecha_ingreso' => 'nullable|date',
            'estado' => 'nullable|in:Disponible,Bajo Stock,Agotado'
        ]);

        $inventario = Inventario::create($validated);

        return redirect()->route('inventario.index')
            ->with('success', "Material creado correctamente. Código: {$inventario->codigo}");
    }

    public function show(Inventario $inventario)
    {
        return view('inventario.show', compact('inventario'));
    }

    public function edit(Inventario $inventario)
    {
        return view('inventario.edit', compact('inventario'));
    }

    public function update(Request $request, Inventario $inventario)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad_disponible' => 'required|integer|min:0',
            'cantidad_minima' => 'required|integer|min:0',
            'precio_unitario' => 'required|numeric|min:0',
            'cantidad_por_paquete' => 'nullable|integer|min:1',
            'precio_por_paquete' => 'nullable|numeric|min:0',
            'ubicacion' => 'nullable|string|max:100',
            'proveedor' => 'nullable|string|max:255',
            'fecha_ingreso' => 'nullable|date',
            'estado' => 'required|in:Disponible,Bajo Stock,Agotado'
        ]);

        $inventario->update($validated);

        return redirect()->route('inventario.index')
            ->with('success', 'Material actualizado correctamente');
    }

    public function destroy(Inventario $inventario)
    {
        $inventario->delete();
        
        return redirect()->route('inventario.index')
            ->with('success', 'Material eliminado correctamente');
    }

    public function actualizarEstados()
    {
        $inventarios = Inventario::all();
        
        foreach ($inventarios as $item) {
            $nuevoEstado = 'Disponible';
            
            if ($item->cantidad_disponible <= 0) {
                $nuevoEstado = 'Agotado';
            } elseif ($item->cantidad_disponible <= $item->cantidad_minima) {
                $nuevoEstado = 'Bajo Stock';
            }
            
            if ($item->estado != $nuevoEstado) {
                $item->estado = $nuevoEstado;
                $item->save();
            }
        }
        
        return redirect()->route('inventario.index')
            ->with('success', 'Estados de inventario actualizados');
    }
}