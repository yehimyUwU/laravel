<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('api')->group(function () {
    Route::get('listarProducto', [ProductoController::class,'index']);
    Route::get('producto/{id}', [PedidoController::class,'show']);
    Route::post('Crearproducto', [ProductoController::class,'store']);
    Route::put('Actualizarproducto', [ProductoController::class,'update']);
    Route::delete('Eliminarproducto', [ProductoController::class,'destroy']);
    Route::get('listarUsuario', [UsuarioController::class,'index']);
    Route::get('usuario/{id}', [UsuarioController::class,'show']);
    Route::post('Crearusuario', [UsuarioController::class,'store']);
    Route::put('Actualizarusuario', [UsuarioController::class,'update']);
    Route::delete('Eliminarusuario', [UsuarioController::class,'destroy']);
    Route::get('listarPedido', [PedidoController::class,'index']);
    Route::get('pedido/{id}', [PedidoController::class,'show']);
    Route::post('CrearPedido', [PedidoController::class,'store']);
    Route::put('ActualizarPedido', [PedidoController::class,'update']);
    Route::delete('EliminarPedido', [PedidoController::class,'destroy']);
});