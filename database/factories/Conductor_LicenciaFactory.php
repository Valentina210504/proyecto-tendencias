<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Conductor;
use App\Models\Licencia;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conductor_Licencia>
 */
class Conductor_LicenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'conductor_id' => Conductor::inRandomOrder()->first()->id, 
            'licencia_id' => Licencia::inRandomOrder()->first()->id, 
            'fecha_asociacion' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'estado_asociacion' => $this->faker->randomElement(['activa', 'inactiva', 'vencida']),
        ];
    }
}