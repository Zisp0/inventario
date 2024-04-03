<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos_pedidos_reportes', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->integer('precio');
            $table->unsignedBigInteger('reporte_id');
            $table->foreign('reporte_id')->references('id')->on('reportes');
            $table->unsignedBigInteger('producto_pedido_id');
            $table->foreign('producto_pedido_id')->references('id')->on('productos_pedidos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_pedidos_reportes');
    }
};