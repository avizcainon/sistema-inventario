<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetallesFactura
 *
 * @property $id
 * @property $id_factura
 * @property $id_producto
 * @property $id_status_producto_factura
 * @property $cantidad_producto_factura
 * @property $monto_producto_factura
 * @property $created_at
 * @property $updated_at
 *
 * @property Factura $factura
 * @property Producto $producto
 * @property StatusProductoFactura $statusProductoFactura
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DetallesFactura extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_factura', 'id_producto', 'id_status_producto_factura', 'cantidad_producto_factura', 'monto_producto_factura'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function factura()
    {
        return $this->belongsTo(\App\Models\Factura::class, 'id_factura', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class, 'id_producto', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function statusProductoFactura()
    {
        return $this->belongsTo(\App\Models\StatusProductoFactura::class, 'id_status_producto_factura', 'id');
    }
    
}
