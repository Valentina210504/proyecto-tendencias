<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contrato;
use App\Models\Conductor;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conductor_Contrato>
 */
class Conductor_ContratoFactory extends Factory
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
            'contrato_id' => Contrato::inRandomOrder()->first()->id,   
            'fecha_asignacion' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'estado_asignacion' => $this->faker->randomElement(['asignado', 'finalizado', 'cancelado']),
        ];
    }
}