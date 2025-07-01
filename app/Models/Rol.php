<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table ='rol';

    protected $primaryKey = 'id_rol';

    public $timestamps = false;

    protected $filltable = [
        'id_rol',
        'nombre_rol'
    ];
    public function rol(): HasMany
    {
        return $this->hasMany(Rol::class, 'id_rol');
    }

}
