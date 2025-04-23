<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = usuario::all();
        return response()->json($usuarios);
    }

     /**
     * Listar todo
     */

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
            return response()->json($validator->errors(), 400);
        }

        $usuarios = usuario::create($validator->validated());
        return response()->json($usuarios, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuarios = usuario::find($id);
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
        $usuarios = usuario::find($id);
        if (!$usuarios) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'string|max:255',
            'apellido' => 'string|max:255',
            'email' => 'string|email|max:255|unique:usuarios,email,' . $id,
            'password' => 'string|min:8',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $usuarios->update($validator->validated());
        return response()->json($usuarios);
    }

    
    public function destroy(string $id)
    {
        $usuarios = usuario::find($id);
        if (!$usuarios) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $usuarios->delete();
        return response()->json(['message' => 'Usuario eliminado con éxito']);
    }
}