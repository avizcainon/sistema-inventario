<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(UsersTypeSeeder::class);
        $this->call(StatusFacturaSeeder::class);
        $this->call(StatusProductoFacturaSeeder::class);
        $this->call(StatusProductoSeeder::class);
        $this->call(TipoFacturaSeeder::class);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'id_user_type' => 1,
        ]);
    }
}
