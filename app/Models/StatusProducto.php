<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StatusProducto
 *
 * @property $id
 * @property $descripcion_status_producto
 * @property $created_at
 * @property $updated_at
 *
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class StatusProducto extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['descripcion_status_producto'];
    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany(\App\Models\Producto::class, 'id', 'id_status_producto');
    }
    
}
