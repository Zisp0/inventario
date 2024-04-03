@extends('base')
@section('title')
    <div class="text-center p-2">
        <a href="/reportes" class="backTo">Volver</a>
        <h1 class="text-3xl mt-8 md:mt-0">CREAR REPORTE PARA USO HUMANO</h1>
    </div>
@endsection
@section('content')
    <form method="POST" action="/reportes/crear" id="pedidoForm" class="flex flex-col items-center mt-4 gap-4">
        @csrf
        <input type="hidden" name="tipo" value="1">
        <ul class="flex flex-col gap-2 w-full items-center">
            @foreach($productos as $producto)
            <li class="flex items-center rounded-lg shadow h-16 w-10/12 md:w-1/2 p-2 justify-between">
                <p>{{$producto->nombre}}</p>
                <div class="flex items-center gap-2">
                    <p>Cantidad disponible: {{$producto->diferencia}}</p>
                    <input type="hidden" name="producto_id[]" value="{{ $producto->id }}">
                    <input type="number" name="vendidos[]" placeholder="Vendidos" min="1" max="{{$producto->diferencia}}" class="inputForm rounded-lg p-2 w-28">
                </div>
            </li>
            @endforeach
        </ul>
        @if (count($productos) == 0)
            <p>No hay productos en inventario</p>
        @else
            <button type="submit" class="submit h-10 w-32 rounded-lg">Crear reporte</button>
        @endif
    </form>
@endsection