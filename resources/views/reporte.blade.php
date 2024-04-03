@extends('base')
@section('title')
    <div class="text-center p-2">
        <a href="/reportes" class="backTo elemento-a-ocultar">Volver</a>
        <h1 class="text-3xl mt-8 md:mt-0">REPORTE {{$reporte->tipo_id == 1 ? 'HUMANO' : 'VETERINARIO' }} DEl {{date('d/m/Y', strtotime($reporte->fecha))}}</h1>
    </div>
@endsection
@section('content')
    <div class="flex flex-col gap-4 items-center justify-center mt-4">
        @foreach ($reporte->productosPedidosReporte as $item)
            <div class="flex items-center rounded-lg shadow h-10 w-10/12 p-2 justify-between">
                <p>{{$item->productoPedido->producto->nombre}}</p>
                <p>Cantidad: {{$item->cantidad}}</p>
                <p>Costo: ${{number_format($item->productoPedido->costo, 0, ',', '.')}}</p>
                <p>Precio: ${{number_format($item->precio, 0, ',', '.')}}</p>
                <p>Ganancia por unidad: ${{number_format($item->precio - $item->productoPedido->costo, 0, ',', '.')}}</p>
            </div>
        @endforeach
        <div class="flex items-center rounded-lg shadow h-10 w-1/2 p-2 justify-between">
            <p>Dinero total: ${{number_format($totalPrecio, 0, ',', '.')}}</p>
            <div class="flex">Dinero para reinversión:&nbsp;<p class="text-orange-600">${{number_format($totalCosto, 0, ',', '.')}}</p></div>
            <div class="flex">Ganancia:&nbsp;<p class="text-lime-600">${{number_format($totalPrecio - $totalCosto, 0, ',', '.')}}</p></div>
        </div>
    </div>
@endsection