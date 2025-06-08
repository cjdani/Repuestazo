<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Desguace;

class DesguaceSeeder extends Seeder
{
    public function run(): void
    {
        Desguace::factory(10)->create();
    }
}
