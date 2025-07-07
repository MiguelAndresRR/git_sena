<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidad_peso_producto';

    public $timestamps = false;

    protected $primaryKey = 'id_unidad_peso_producto';

    protected $fillable = [
        'nombre_unidad_peso_producto',
        'descripcion_unidad_peso_producto'
    ];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_unidad_peso_producto');
    }
}
