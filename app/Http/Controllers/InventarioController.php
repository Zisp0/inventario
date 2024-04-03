<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class InventarioController extends Controller
{
    public function show(){
        $productosHumanos = Producto::select('productos.nombre')->where('tipo_id', 1)
            ->selectRaw('COALESCE(SUM(productos_pedidos.cantidad), 0) - COALESCE(SUM(productos_pedidos.vendidos), 0) as diferencia')
            ->leftJoin('productos_pedidos', 'productos.id', '=', 'productos_pedidos.producto_id')
            ->groupBy('productos.id', 'productos.nombre')
            ->orderBy('productos.nombre')
            ->get();

        $productosVeterinarios = Producto::select('productos.nombre')->where('tipo_id', 2)
            ->selectRaw('COALESCE(SUM(productos_pedidos.cantidad), 0) - COALESCE(SUM(productos_pedidos.vendidos), 0) as diferencia')
            ->leftJoin('productos_pedidos', 'productos.id', '=', 'productos_pedidos.producto_id')
            ->groupBy('productos.id', 'productos.nombre')
            ->orderBy('productos.nombre')
            ->get();

        return view('inventario', ['productosHumanos' => $productosHumanos, 'productosVeterinarios' => $productosVeterinarios]);
    }
}
