<?php

namespace App\Http\Controllers;
use App\Models\pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $pedidos = pedido::all();
       // $pedidos = pedido::with(['usuario', 'producto'])->get(); con este tambien se puede hacer union de la tablas como con all
        return response()->json($pedidos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_productos' => 'required|exists:productos,id',
            'id_usuario' => 'required|exists:usuarios,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pedido = pedido::create($request->all());
        return response()->json($pedido, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pedido = pedido::find($id);
        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }
        return response()->json($pedido);
    }

    
    public function update(Request $request, string $id)
    {
        $pedido = pedido::find($id);
        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_productos' => 'required|exists:productos,id',
            'id_usuario' => 'required|exists:usuarios,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pedido->update($request->all());
        return response()->json($pedido, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pedido = pedido::find($id);
        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }
        $pedido->delete();
        return response()->json(['message' => 'Pedido eliminado'], 204);
    }
}
