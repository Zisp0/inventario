<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\ProductoPedido;

class PedidoController extends Controller
{
    public function show(){
        $pedidosHumanos = Pedido::where('tipo_id', 1)->orderBy('fecha')->get();
        $pedidosVeterinarios = Pedido::where('tipo_id', 2)->orderBy('fecha')->get();
        return view('pedidos', ['pedidosHumanos' => $pedidosHumanos, 'pedidosVeterinarios' => $pedidosVeterinarios]);
    }

    public function store(Request $request){
        $pedido = new Pedido();
        $pedido->fecha = now();
        $pedido->tipo_id = $request->input('tipo');
        $pedido->save();

        foreach ($request->producto_id as $key => $producto_id) {
            if($request->cantidad[$key] == null) continue;
            $productoPedido = new ProductoPedido();
            $productoPedido->pedido_id = $pedido->id;
            $productoPedido->producto_id = $producto_id;
            $productoPedido->cantidad = $request->cantidad[$key];
            $productoPedido->costo = $request->costo[$key];
            $productoPedido->vendidos = 0;
            $productoPedido->save();
        }

        return redirect('/pedidos');
    }

    public function humano(){
        $productos = Producto::where('tipo_id', 1)->where('estado', 1)->orderBy('nombre')->get();
        return view('crearPedidoHumano', ['productos' => $productos]);
    }

    public function veterinario(){
        $productos = Producto::where('tipo_id', 2)->where('estado', 1)->orderBy('nombre')->get();
        return view('crearPedidoVeterinario', ['productos' => $productos]);
    }

    public function index(int $id){
        $pedido = Pedido::with('productosPedido.producto')->find($id);
        $pedido->productosPedido = $pedido->productosPedido->sortBy('producto.nombre')->values()->all();
        return view('pedido', ['pedido' => $pedido]);
    }

    public function disponibles(int $id){
        $pedido = Pedido::find($id);
        $productos = Producto::where('tipo_id', $pedido->tipo_id)->where('estado', 1)->orderBy('nombre')->whereDoesntHave('productoPedidos', function ($query) use ($id) {
            $query->where('pedido_id', $id);
        })->get();
        return view('editarPedido', ['productos' => $productos, 'pedido' => $pedido]);
    }

    public function update(Request $request, int $id){
        foreach ($request->producto_id as $key => $producto_id) {
            if($request->cantidad[$key] == null) continue;
            $productoPedido = new ProductoPedido();
            $productoPedido->pedido_id = $id;
            $productoPedido->producto_id = $producto_id;
            $productoPedido->cantidad = $request->cantidad[$key];
            $productoPedido->costo = $request->costo[$key];
            $productoPedido->vendidos = 0;
            $productoPedido->save();
        }

        return redirect('/pedidos/'.$id);
    }
}
