<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function tipo(){
        return $this->belongsTo(Tipo::class);
    }

    public function productosPedido(){
        return $this->hasMany(ProductoPedido::class);
    }
}
