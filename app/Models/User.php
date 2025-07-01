<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'usuario';

    protected $primaryKey = 'id_usuario';

    public $timestamps = false;

    protected $fillable = [
        'user',
        'password',
        'id_rol',
        'documento_usuario',
        'telefono_usuario',
        'nombre_usuario',
        'apellido_usuario',
        'correo_usuario'
    ];

    protected $hidden = [
        'password',
        'user'
    ];
        public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

}
