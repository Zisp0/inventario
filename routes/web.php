<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoPedidoController;
use App\Http\Controllers\ReporteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('home');});
Route::get('/inventario', [InventarioController::class, 'show']);
Route::get('/productos', [ProductoController::class, 'show']);
Route::get('/productos/crear', function () {return view('crearProducto');});
Route::get('/productos/{id}', [ProductoController::class, 'index']);
Route::post('/productos/crear', [ProductoController::class, 'store']);
Route::put('/productos/editar/{id}', [ProductoController::class, 'update']);
Route::get('/pedidos', [PedidoController::class, 'show']);
Route::post('pedidos/crear', [PedidoController::class, 'store']);
Route::get('/pedidos/crear/humano', [PedidoController::class, 'humano']);
Route::get('/pedidos/crear/veterinario', [PedidoController::class, 'veterinario']);
Route::get('/pedidos/producto-pedido/{id}', [ProductoPedidoController::class, 'show']);
Route::put('/pedidos/producto-pedido/{id}', [ProductoPedidoController::class, 'update']);
Route::get('/pedidos/{id}', [PedidoController::class, 'index']);
Route::get('/pedidos/{id}/editar', [PedidoController::class, 'disponibles']);
Route::post('/pedidos/{id}/editar', [PedidoController::class, 'update']);
Route::get('/reportes', [ReporteController::class, 'show']);
Route::post('/reportes/crear', [ReporteController::class, 'store']);
Route::get('/reportes/crear/humano', [ReporteController::class, 'humano']);
Route::get('/reportes/crear/veterinario', [ReporteController::class, 'veterinario']);
Route::get('/reportes/{id}', [ReporteController::class, 'index']);