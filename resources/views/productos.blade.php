@extends('base')
@section('title')
    <div class="text-center p-2">
        <a href="/" class="backTo">Volver</a>
        <h1 class="text-3xl mt-8 md:mt-0">PRODUCTOS</h1>
    </div>
@endsection
@section('content')
    <div class="flex flex-col gap-4 items-center justify-center mt-4">
        @if ($productosHumanos->count() == 0 && $productosVeterinarios->count() == 0)
            <h2 class="text-2xl">No se encontraron productos</h2>
        @else
            @if ($productosHumanos->count() != 0)  
                <h3 class="text-xl">Productos de uso humano</h3>
                @foreach ($productosHumanos as $producto)
                    <div class="flex items-center rounded-lg shadow h-10 w-10/12 md:w-1/2 p-2 justify-between">
                        <p>{{$producto->nombre}}</p>
                        <div class="flex gap-2">
                            @if ($producto->estado != 1)
                                <p class="retired rounded-lg px-2">Retirado</p>
                            @endif
                            <p>${{number_format($producto->precio, 0, ',', '.')}}</p>
                            <a href="/productos/{{$producto->id}}" class="green rounded-lg px-2">Editar</a>
                        </div>
                    </div>
                @endforeach
            @endif
            @if ($productosVeterinarios->count() != 0)
                <h3 class="text-xl">Productos de uso veterinario</h3>
                @foreach ($productosVeterinarios as $producto)
                    <div class="flex items-center rounded-lg shadow h-10 w-10/12 md:w-1/2 p-2 justify-between">
                        <p>{{$producto->nombre}}</p>
                        <div class="flex gap-2">
                            @if ($producto->estado != 1)
                                <p class="retired rounded-lg px-2">Retirado</p>
                            @endif
                            <p>${{number_format($producto->precio, 0, ',', '.')}}</p>
                            <a href="/productos/{{$producto->id}}" class="green rounded-lg px-2">Editar</a>
                        </div>
                    </div>
                @endforeach
            @endif
        @endif
        <a href="/productos/crear" class="blue fixed bottom-4 right-4 p-2 rounded-lg justify-between items-center">Añadir producto</a>
    </div>
@endsection