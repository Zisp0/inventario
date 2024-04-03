<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoPedidoReporte extends Model
{
    use HasFactory;

    protected $table = 'productos_pedidos_reportes';
    public $timestamps = false;

    public function productoPedido(){
        return $this->belongsTo(ProductoPedido::class);
    }

    public function reporte(){
        return $this->belongsTo(Reporte::class);
    }
}
