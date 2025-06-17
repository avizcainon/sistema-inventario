<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StatusFactura
 *
 * @property $id
 * @property $descripcion_status_factura
 * @property $created_at
 * @property $updated_at
 *
 * @property Factura[] $facturas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class StatusFactura extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['descripcion_status_factura'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facturas()
    {
        return $this->hasMany(\App\Models\Factura::class, 'id', 'id_status_factura');
    }
    
}
