@extends('base')
@section('title')
    <div class="text-center p-2">
        <a href="/" class="backTo">Volver</a>
        <h1 class="text-3xl mt-8 md:mt-0">REPORTES</h1>
    </div>
@endsection
@section('content')
    <div class="flex flex-col gap-4 items-center justify-center mt-4">
        @if ($reportesHumanos->count() == 0 && $reportesVeterinarios->count() == 0)
            <h2 class="text-2xl">No se encontraron reportes</h2>
        @else
            @if ($reportesHumanos->count() != 0)  
                <h3 class="text-xl">Reportes de uso humano</h3>
                @foreach ($reportesHumanos as $reporte)
                    <a href="/reportes/{{$reporte->id}}" class="flex items-center rounded-lg shadow h-10 w-10/12 md:w-1/2 p-2 text-lg">Reporte del {{date('d/m/Y', strtotime($reporte->fecha))}}</a>
                @endforeach
            @endif
            @if ($reportesVeterinarios->count() != 0)
                <h3 class="text-xl">Reportes de uso veterinario</h3>
                @foreach ($reportesVeterinarios as $reporte)
                    <a href="/reportes/{{$reporte->id}}" class="flex items-center rounded-lg shadow h-10 w-10/12 md:w-1/2 p-2 text-lg">Reporte del {{date('d/m/Y', strtotime($reporte->fecha))}}</a>
                @endforeach
            @endif
        @endif
        <a href="/reportes/crear/humano" class="blue fixed bottom-16 mb-2 right-4 p-2 rounded-lg justify-between items-center">Añadir reporte de uso humano</a>
        <a href="/reportes/crear/veterinario" class="blue fixed bottom-4 right-4 p-2 rounded-lg justify-between items-center">Añadir reporte de uso veterinario</a>
    </div>
@endsection