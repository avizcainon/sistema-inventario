<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users_type')->insert([
            'description_user_type' => 'Administrador',
            'created_at'  => now(),
            'updated_at'  => now(),
            
        ]);
        DB::table('users_type')->insert([
            
            'description_user_type' => 'Asesor',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
