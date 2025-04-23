<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen'
    ];

    public function pedido()
    {
        return $this->hasMany(pedido::class, 'id_productos');
    }
}
