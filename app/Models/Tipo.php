<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    public function productos(){
        return $this->hasMany(Producto::class);
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }

    public function reportes(){
        return $this->hasMany(Reporte::class);
    }
}
