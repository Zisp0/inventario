@extends('base')
@section('title')
    <div class="text-center p-2">
        <a href="/pedidos/{{$pedido->id}}" class="backTo">Volver</a>
        <h1 class="text-3xl mt-8 md:mt-0">EDITAR PEDIDO DEL {{date('d/m/Y', strtotime($pedido->fecha))}}</h1>
    </div>
@endsection
@section('content')
    <form method="POST" action="/pedidos/{{$pedido->id}}/editar" id="pedidoForm" class="flex flex-col items-center mt-4 gap-4">
        @csrf
        <input type="hidden" name="tipo" value="1">
        <ul class="flex flex-col gap-2 w-full items-center">
            @foreach($productos as $producto)
            <li class="flex items-center rounded-lg shadow h-16 w-10/12 md:w-1/2 p-2 justify-between">
                <p>{{$producto->nombre}}</p>
                <div>
                    <input type="hidden" name="producto_id[]" value="{{ $producto->id }}">
                    <input type="number" name="costo[]" placeholder="Costo" min="1" class="costo inputForm rounded-lg p-2 w-24">
                    <input type="number" name="cantidad[]" placeholder="Cantidad" min="1" class="cantidad inputForm rounded-lg p-2 w-24">
                </div>
            </li>
            @endforeach
        </ul>
        @if (count($productos) == 0)
            <p>No hay productos disponibles</p>
        @else
            <button type="submit" class="submit h-10 w-32 rounded-lg">Guardar cambios</button>
        @endif
    </form>
@endsection
<script src="{{ asset('js/pedidos.js') }}"></script>