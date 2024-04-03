<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoPedido;
use App\Models\ProductoPedidoReporte;

class ProductoPedidoController extends Controller
{
    public function show (int $id){
        $productoPedido = ProductoPedido::with('producto')->find($id);
        $error = null;
        return view('productoPedido', ['productoPedido' => $productoPedido, 'error' => $error]);
    }

    public function update (Request $request, int $id){
        $productoPedido = ProductoPedido::with('producto')->find($id);
        $productoPedido->costo = $request->input('costo');
        $productoPedido->cantidad = $request->input('cantidad');
        if ($request->has('retirar')) {
            $reportes = ProductoPedidoReporte::where('producto_pedido_id', $id)->get();
            if(count($reportes) > 0){
                return view('productoPedido', ['productoPedido' => $productoPedido, 'error' => true]);
            }
            $productoPedido->delete();
            return redirect('pedidos/'.$productoPedido->pedido_id);
        }
        $productoPedido->save();
        return redirect('pedidos/'.$productoPedido->pedido_id);
    }
}
