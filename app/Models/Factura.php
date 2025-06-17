<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Factura
 *
 * @property $id
 * @property $id_cliente
 * @property $id_tipo_factura
 * @property $id_status_factura
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property StatusFactura $statusFactura
 * @property TipoFactura $tipoFactura
 * @property DetallesFactura[] $detallesFacturas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Factura extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_cliente', 'id_tipo_factura', 'id_status_factura'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(\App\Models\Cliente::class, 'id_cliente', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function statusFactura()
    {
        return $this->belongsTo(\App\Models\StatusFactura::class, 'id_status_factura', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoFactura()
    {
        return $this->belongsTo(\App\Models\TipoFactura::class, 'id_tipo_factura', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallesFacturas()
    {
        return $this->hasMany(\App\Models\DetallesFactura::class, 'id', 'id_factura');
    }
    
}
