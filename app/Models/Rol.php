<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;

    protected $table ='rol';

    protected $primaryKey = 'id_rol';

    public $timestamps = false;

    protected $filltable = [
        'id_rol',
        'nombre_rol'
    ];
    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class, 'id_rol');
    }

}
