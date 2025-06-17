<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusProductoFacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('status_producto_facturas')->insert([
            
            'descripcion_status_producto_factura' => 'Activo',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        DB::table('status_producto_facturas')->insert([
            
            'descripcion_status_producto_factura' => 'Devuelto',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
