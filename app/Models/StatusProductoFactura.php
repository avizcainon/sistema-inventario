<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StatusProductoFactura
 *
 * @property $id
 * @property $descripcion_status_producto_factura
 * @property $created_at
 * @property $updated_at
 *
 * @property DetallesFactura[] $detallesFacturas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class StatusProductoFactura extends Model
{
    protected $table = 'status_producto_facturas';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['descripcion_status_producto_factura'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallesFacturas()
    {
        return $this->hasMany(\App\Models\DetallesFactura::class, 'id', 'id_status_producto_factura');
    }
    
}
