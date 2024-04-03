<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;
use App\Models\Producto;
use App\Models\ProductoPedido;
use App\Models\ProductoPedidoReporte;

class ReporteController extends Controller
{
    public function show(){
        $reportesHumanos = Reporte::where('tipo_id', 1)->orderBy('fecha')->get();
        $reportesVeterinarios = Reporte::where('tipo_id', 2)->orderBy('fecha')->get();
        return view('reportes', ['reportesHumanos' => $reportesHumanos, 'reportesVeterinarios' => $reportesVeterinarios]);
    }

    public function store(Request $request){
        $reporte = new Reporte();
        $reporte->fecha = now();
        $reporte->tipo_id = $request->input('tipo');
        $reporte->save();

        foreach ($request->producto_id as $key => $producto_id) {
            if($request->vendidos[$key] == null) continue;
            $productoPedidos = ProductoPedido::where('producto_id', $producto_id)
                ->where('cantidad', '<>', 'vendidos')
                ->get();
            $restante = $request->vendidos[$key];
            $producto = Producto::find($producto_id);
            foreach ($productoPedidos as $ke => $value) {
                if($restante == 0) break;
                $disponibles = $value->cantidad - $value->vendidos;
                $productoPedidoReporte = new ProductoPedidoReporte();
                $productoPedidoReporte->reporte_id = $reporte->id;
                $productoPedidoReporte->producto_pedido_id = $value->id;
                $productoPedidoReporte->precio = $producto->precio;
                if($disponibles <= $restante){
                    $restante = $restante - $disponibles;
                    $value->vendidos = $value->cantidad;
                    $productoPedidoReporte->cantidad = $disponibles;
                }else{
                    $value->vendidos += $restante;
                    $productoPedidoReporte->cantidad = $restante;
                }
                $productoPedidoReporte->save();
                $value->save();
            }
        }

        return redirect('/reportes/'.$reporte->id);
    }

    public function humano(){
        $productos = Producto::select('productos.nombre', 'productos.id')->where('tipo_id', 1)
            ->selectRaw('COALESCE(SUM(productos_pedidos.cantidad), 0) - COALESCE(SUM(productos_pedidos.vendidos), 0) as diferencia')
            ->leftJoin('productos_pedidos', 'productos.id', '=', 'productos_pedidos.producto_id')
            ->groupBy('productos.id', 'productos.nombre')
            ->havingRaw('diferencia > 0')
            ->orderBy('productos.nombre')
            ->get();
        return view('crearReporteHumano', ['productos' => $productos]);
    }

    public function veterinario(){
        $productos = Producto::select('productos.nombre', 'productos.id')->where('tipo_id', 2)
            ->selectRaw('COALESCE(SUM(productos_pedidos.cantidad), 0) - COALESCE(SUM(productos_pedidos.vendidos), 0) as diferencia')
            ->leftJoin('productos_pedidos', 'productos.id', '=', 'productos_pedidos.producto_id')
            ->groupBy('productos.id', 'productos.nombre')
            ->havingRaw('diferencia > 0')
            ->orderBy('productos.nombre')
            ->get();
        return view('crearReporteVeterinario', ['productos' => $productos]);
    }

    public function index(int $id){
        $reporte = Reporte::with('productosPedidosReporte.productoPedido.producto')->find($id);
        $totalCosto = 0;
        $totalPrecio = 0;

        foreach ($reporte->productosPedidosReporte as $key => $value) {
            $totalCosto += $value->cantidad * $value->productoPedido->costo;
            $totalPrecio += $value->cantidad * $value->precio;
        }

        return view('reporte', ['reporte' => $reporte, 'totalCosto' => $totalCosto, 'totalPrecio' => $totalPrecio]);
    }
}
