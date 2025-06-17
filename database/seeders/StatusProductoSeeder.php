<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusProductoSeeder extends Seeder
{
   /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('status_productos')->insert([
            
            'descripcion_status_producto' => 'Activo',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        DB::table('status_productos')->insert([
            
            'descripcion_status_producto' => 'Inactivo',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
