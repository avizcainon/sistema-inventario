<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusFacturaSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('status_facturas')->insert([
            
            'descripcion_status_factura' => 'Abierta',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        DB::table('status_facturas')->insert([
            
            'descripcion_status_factura' => 'Pagada',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
