<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contrato>
 */
class ContratoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaInicio = $this->faker->dateTimeBetween('-5 years', 'now');
        $fechaFinal = $this->faker->boolean(70) 
            ? (clone $fechaInicio)->modify('+' . $this->faker->numberBetween(1, 36) . ' months')
            : null;

        return [
            'fecha_inicio' => $fechaInicio->format('Y-m-d'),
            'fecha_final' => $fechaFinal ? $fechaFinal->format('Y-m-d') : null,
            'salario' => $this->faker->randomFloat(2, 1200000, 6000000), 
            'estado' => $this->faker->randomElement(['activo', 'finalizado', 'suspendido']),
            'registrado_por' => $this->faker->name,
        ];
    }
}