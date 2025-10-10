<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ruta;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ruta>
 */
class RutaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_ruta' => $this->faker->city . ' - ' . $this->faker->city,
            'descripcion' => $this->faker->sentence(8),
            'distancia_en_km' => $this->faker->randomFloat(2, 5, 500), 
            'tiempo_estimado' => $this->faker->time(), 
            'costo_peaje' => $this->faker->randomFloat(2, 0, 150), 
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'registrado_por' => $this->faker->name,
        ];
    }
}