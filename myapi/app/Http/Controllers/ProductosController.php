<?php

namespace App\Http\Controllers;

use App\Models\productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los productos
        $productos = \App\Models\productos::all();

        // Retornar la respuesta en formato JSON
        return response()->json($productos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria' => 'required|string|max:255',
        ]);

        

        // Retornar la respuesta en formato JSON
        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar el producto por ID
        $producto = \App\Models\productos::find($id);

        // Verificar si el producto existe
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Retornar la respuesta en formato JSON
        return response()->json($producto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Verificar si el producto existe
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string|max:255',
            'precio' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
            'categoria' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);

        // Retornar la respuesta en formato JSON
        return response()->json($producto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        

        // Verificar si el producto existe
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        // Eliminar el producto
        $producto->delete();

        // Retornar la respuesta en formato JSON
        return response()->json(['message' => 'Producto eliminado con éxito']);
    }
}
