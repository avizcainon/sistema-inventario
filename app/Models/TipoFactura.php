<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoFactura
 *
 * @property $id
 * @property $descripcion_tipo_factura
 * @property $created_at
 * @property $updated_at
 *
 * @property Factura[] $facturas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoFactura extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['descripcion_tipo_factura'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facturas()
    {
        return $this->hasMany(\App\Models\Factura::class, 'id', 'id_tipo_factura');
    }
    
}
