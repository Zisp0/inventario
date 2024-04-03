@extends('base')
@section('title')
    <div class="text-center p-2">
        <a href="/pedidos" class="backTo">Volver</a>
        <h1 class="text-3xl mt-8 md:mt-0">PEDIDO DEL {{date('d/m/Y', strtotime($pedido->fecha))}}</h1>
    </div>
@endsection
@section('content')
    <div class="flex flex-col gap-4 items-center justify-center mt-4">
        @foreach ($pedido->productosPedido as $productoPedido)
            <div class="flex items-center rounded-lg shadow h-10 w-10/12 md:w-1/2 p-2 justify-between">
                <p>{{$productoPedido->producto->nombre}}</p>
                <div class="flex gap-2">
                    <p>Costo: ${{number_format($productoPedido->costo, 0, ',', '.')}}</p>
                    <p>Cantidad : {{$productoPedido->cantidad}}</p>
                    <a href="/pedidos/producto-pedido/{{$productoPedido->id}}" class="green rounded-lg px-2">Editar</a>
                </div>
            </div>
        @endforeach
        <a href="/pedidos/{{$pedido->id}}/editar" class="blue fixed bottom-4 right-4 p-2 rounded-lg justify-between items-center">Añadir productos</a>
    </div>
@endsection