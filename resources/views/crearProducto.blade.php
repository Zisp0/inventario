@extends('base')
@section('title')
    <div class="text-center p-2">
        <a href="/productos" class="backTo">Volver</a>
        <h1 class="text-3xl mt-8 md:mt-0">AÑADIR PRODUCTO</h1>
    </div>
@endsection
@section('content')
    <form class="flex justify-center mt-4"action="/productos/crear" method="post">
        @csrf
        <div class="flex flex-col gap-2 w-64 p-4 rounded-lg shadow-md p-2">
            <label for="nombre">Nombre del producto</label>
            <input type="text" name="nombre" id="nombre" class="inputForm rounded-lg w-full p-2" required>
            <label for="precio" class="mt-2">Precio de venta</label>
            <input type="number" name="precio" id="precio" class="inputForm rounded-lg w-full p-2" min="0" required>
            <label for="tipo" class="mt-2">Tipo de uso</label>
            <div class="flex gap-2">
                <input type="radio" name="tipo" id="tipo1" value="1" required>
                <label for="tipo">Uso humano</label>
            </div>
            <div class="flex gap-2">
                <input type="radio" name="tipo" id="tipo2" value="2" required>
                <label for="tipo">Uso veterinario</label>
            </div>
            <div class="flex justify-center gap-2 mt-4">
                <button type="submit" class="submit h-10 w-32 rounded-lg">Añadir producto</button>
            </div>
        </div>
    </form>
@endsection