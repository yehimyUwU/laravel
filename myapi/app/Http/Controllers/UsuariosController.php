<?php

namespace App\Http\Controllers;

use App\Models\usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = usuarios::all();
        return response()->json($usuarios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $usuarios =usuarios::create($validator->validated());
        return response()->json($usuarios, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuarios = usuarios::find($id);
        if (!$usuarios) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuarios);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuarios = usuarios::find($id);
        if (!$usuarios) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:usuarios,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $usuarios->update($validator->validated());
        return response()->json($usuarios);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuarios = usuarios::find($id);
        if (!$usuarios) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        $usuarios->delete();
        return response()->json(['message' => 'Usuario eliminado con éxito']);
    }
}