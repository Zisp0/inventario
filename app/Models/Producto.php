<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'precio',
        'tipo_id',
        'estado'
    ];

    public $timestamps = false;

    public function tipo(){
        return $this->belongsTo(Tipo::class);
    }

    public function productoPedidos(){
        return $this->hasMany(ProductoPedido::class);
    }
}
