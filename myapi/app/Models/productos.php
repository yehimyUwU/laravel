<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;
    protected $fillable =[
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria'
    ];
    public function pedidos()
    {
        return $this->hasMany(pedido::class, 'usuario_id');
    }
}
