<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoPedido extends Model
{
    use HasFactory;

    protected $table = 'productos_pedidos';
    public $timestamps = false;

    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }
}