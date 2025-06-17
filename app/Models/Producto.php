<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $codigo_producto
 * @property $descripcion_producto
 * @property $cantidad_producto
 * @property $monto_producto_compra
 * @property $monto_producto_venta
 * @property $medida_producto
 * @property $id_status_producto
 * @property $created_at
 * @property $updated_at
 *
 * @property StatusProducto $statusProducto
 * @property DetallesFactura[] $detallesFacturas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['codigo_producto', 'imagen_producto','descripcion_producto', 'cantidad_producto', 'monto_producto_compra', 'monto_producto_venta', 'medida_producto', 'id_status_producto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function statusProducto()
    {
        return $this->belongsTo(\App\Models\StatusProducto::class, 'id_status_producto', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallesFacturas()
    {
        return $this->hasMany(\App\Models\DetallesFactura::class, 'id', 'id_producto');
    }
    
}
