<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoFacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_facturas')->insert([
            'descripcion_tipo_factura' => 'Compra',
            'created_at'  => now(),
            'updated_at'  => now(),
            
        ]);
        DB::table('tipo_facturas')->insert([
            
            'descripcion_tipo_factura' => 'Venta',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        DB::table('tipo_facturas')->insert([
            
            'descripcion_tipo_factura' => 'Devolución',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
