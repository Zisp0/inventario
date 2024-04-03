<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    public function productosPedidosReporte(){
        return $this->hasMany(ProductoPedidoReporte::class);
    }

    public function tipo(){
        return $this->belongsTo(Tipo::class);
    }
}
