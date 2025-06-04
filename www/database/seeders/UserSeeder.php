<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Desguace;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desguaces = Desguace::factory()->count(3)->create();

        foreach ($desguaces as $desguace) {
            User::factory()->count(2)->create([
                'desguace_id' => $desguace->id,
            ]);
        }

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@demo.com',
            'role' => 'admin'
        ]);
    }
}
