<?php

namespace App\Http\Controllers;

use App\Models\producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = producto::all();
        return response()->json($productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen' => 'nullable|url'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $producto = producto::create($request->all());
        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = producto::find($id);
        if ($producto) {
            return response()->json($producto);
        } else {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string|max:255',
            'precio' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
            'imagen' => 'sometimes|nullable|url'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $producto = producto::find($id);
        if ($producto) {
            $producto->update($request->all());
            return response()->json($producto);
        } else {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = producto::find($id);
        if ($producto) {
            $producto->delete();
            return response()->json(['message' => 'Producto eliminado con éxito']);
        } else {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    }
}
