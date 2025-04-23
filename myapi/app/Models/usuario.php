<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $table = 'usuario';
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'direccion'
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
}
