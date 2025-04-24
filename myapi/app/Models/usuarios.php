<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class usuarios extends Model
{
    use HasFactory;
    protected $fillable =[
        'nombre',
        'apellido',
        'email',
        'password',
        'telefono',
        'direccion'
    ];
    public function pedidos()
    {
        return $this->hasMany(pedido::class, 'usuario_id');
    }
}