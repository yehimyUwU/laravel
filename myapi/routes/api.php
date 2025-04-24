<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('api')->group(function () {
    Route::get('listarProductos', [ProductoController::class,'index']);
    Route::get('productos/{id}', [PedidoController::class,'show']);
    Route::post('Crearproductos', [ProductoController::class,'store']);
    Route::put('Actualizarproductos', [ProductoController::class,'update']);
    Route::delete('Eliminarproductos', [ProductoController::class,'destroy']);
    Route::get('listarUsuarios', [UsuariosController::class,'index']);
    Route::get('usuarios/{id}', [UsuariosController::class,'show']);
    Route::post('Crearusuarios', [UsuariosController::class,'store']);
    Route::put('Actualizarusuarios', [UsuariosController::class,'update']);
    Route::delete('Eliminarusuarios', [UsuariosController::class,'destroy']);
    Route::get('listarPedidos', [PedidoController::class,'index']);
    Route::get('pedidos/{id}', [PedidoController::class,'show']);
    Route::post('CrearPedidos', [PedidoController::class,'store']);
    Route::put('ActualizarPedidos', [PedidoController::class,'update']);
    Route::delete('EliminarPedidos', [PedidoController::class,'destroy']);
});