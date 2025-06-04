<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Desguace;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar primero DesguaceSeeder
        $this->call(DesguaceSeeder::class);

        // Crear usuarios manuales
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'desguace_id' => null,
        ]);

        User::factory()->create([
            'name' => 'Cliente User',
            'email' => 'cliente@example.com',
            'role' => 'cliente',
            'desguace_id' => null,
        ]);

        User::factory()->create([
            'name' => 'Empleado User',
            'email' => 'empleado@example.com',
            'role' => 'empleado',
            'desguace_id' => Desguace::inRandomOrder()->value('id'),
        ]);

        // Crear usuarios aleatorios
        User::factory(10)->create();

        // Ejecutar luego ArticuloSeeder (requiere desguaces existentes)
        $this->call(ArticuloSeeder::class);
    }
}
