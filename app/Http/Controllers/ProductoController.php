<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function show(){
        $productosHumanos = Producto::where('tipo_id', 1)->orderBy('nombre')->get();
        $productosVeterinarios = Producto::where('tipo_id', 2)->orderBy('nombre')->get();
        return view('productos', ['productosHumanos' => $productosHumanos, 'productosVeterinarios' => $productosVeterinarios]);
    }

    public function store(Request $request){
        Producto::create([
            'nombre' => $request->input('nombre'),
            'precio' => $request->input('precio'),
            'tipo_id' => $request->input('tipo'),
            'estado' => true
        ]);
        return redirect('/productos');
    }

    public function index(int $id){
        $producto = Producto::find($id);
        return view('editarProducto', ['producto' => $producto]);
    }

    public function update(Request $request, int $id){
        $producto = Producto::find($id);
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->tipo_id = $request->input('tipo');
        if ($request->has('estado')) {
            $producto->estado = $producto->estado == 1 ? 2 : 1;
        }
        $producto->save();
        return redirect('/productos');
    }
}
