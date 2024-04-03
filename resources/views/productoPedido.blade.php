@extends('base')
@section('title')
    <div class="text-center p-2">
        <a href="/pedidos/{{$productoPedido->pedido_id}}" class="backTo">Volver</a>
        <h1 class="text-3xl mt-8 md:mt-0">EDITAR PRODUCTO PEDIDO</h1>
    </div>
@endsection
@section('content')
    <form class="flex justify-center mt-4"action="/pedidos/producto-pedido/{{$productoPedido->id}}" method="post">
        @csrf
        @method('PUT')
        <div class="flex flex-col gap-2 w-64 p-4 rounded-lg shadow-md p-2">
            <h2 class="text-2xl">{{$productoPedido->producto->nombre}}</h2>
            <label for="costo" class="mt-2">Costo</label>
            <input type="number" name="costo" id="costo" class="inputForm rounded-lg w-full p-2" min="0" value="{{$productoPedido->costo}}" required>
            <label for="cantidad" class="mt-2">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="inputForm rounded-lg w-full p-2" min="0" value="{{$productoPedido->cantidad}}" required>
            <div class="flex gap-2 mt-2">
                <input type="checkbox" name="retirar" id="retirar">
                <label for="retirar">Retirar</label>
            </div>
            @if ($error != null)
                <small>El producto no se puede retirar debido a que tiene reportes asociados a él</small>
            @endif
            <div class="flex justify-center gap-2 mt-4">
                <button type="submit" class="submit h-10 w-32 rounded-lg">Guardar cambios</button>
            </div>
        </div>
    </form>
@endsection