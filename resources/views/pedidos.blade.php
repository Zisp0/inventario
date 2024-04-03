@extends('base')
@section('title')
    <div class="text-center p-2">
        <a href="/" class="backTo">Volver</a>
        <h1 class="text-3xl mt-8 md:mt-0">PEDIDOS</h1>
    </div>
@endsection
@section('content')
    <div class="flex flex-col gap-4 items-center justify-center mt-4">
        @if ($pedidosHumanos->count() == 0 && $pedidosVeterinarios->count() == 0)
            <h2 class="text-2xl">No se encontraron pedidos</h2>
        @else
            @if ($pedidosHumanos->count() != 0)  
                <h3 class="text-xl">Pedidos de uso humano</h3>
                @foreach ($pedidosHumanos as $pedido)
                    <a href="/pedidos/{{$pedido->id}}" class="flex items-center rounded-lg shadow h-10 w-10/12 md:w-1/2 p-2 text-lg">Pedido del {{date('d/m/Y', strtotime($pedido->fecha))}}</a>
                @endforeach
            @endif
            @if ($pedidosVeterinarios->count() != 0)
                <h3 class="text-xl">Pedidos de uso veterinario</h3>
                @foreach ($pedidosVeterinarios as $pedido)
                    <a href="/pedidos/{{$pedido->id}}" class="flex items-center rounded-lg shadow h-10 w-10/12 md:w-1/2 p-2 text-lg">Pedido del {{date('d/m/Y', strtotime($pedido->fecha))}}</a>
                @endforeach
            @endif
        @endif
        <a href="/pedidos/crear/humano" class="blue fixed bottom-16 mb-2 right-4 p-2 rounded-lg justify-between items-center">Añadir pedido de uso humano</a>
        <a href="/pedidos/crear/veterinario" class="blue fixed bottom-4 right-4 p-2 rounded-lg justify-between items-center">Añadir pedido de uso veterinario</a>
    </div>
@endsection