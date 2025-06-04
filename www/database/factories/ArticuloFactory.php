<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Desguace;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ArticuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word,
            'precio' => $this->faker->randomFloat(2, 10, 500),
            'descripcion' => $this->faker->sentence,
            'desguace_id' => Desguace::inRandomOrder()->value('id'),
            'anio' => $this->faker->year,
            'marca' => $this->faker->company,
            'modelo' => $this->faker->word,
            'categoria' => $this->faker->word,
        ];
    }
}
