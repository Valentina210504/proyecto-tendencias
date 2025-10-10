<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Licencia>
 */
class LicenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaExpedicion = $this->faker->dateTimeBetween('-10 years', 'now');
        $fechaVencimiento = (clone $fechaExpedicion)->modify('+3 years');

        return [
            'numero_licencia' => $this->faker->unique()->bothify('LIC-####-####'),
            'tipo_licencia' => $this->faker->randomElement(['A1', 'A2', 'B1', 'B2', 'C1', 'C2']),
            'fecha_expedicion' => $fechaExpedicion->format('Y-m-d'),
            'fecha_vencimiento' => $fechaVencimiento->format('Y-m-d'),
            'entidad_emisora' => $this->faker->company . ' Secretaría de Tránsito',
            'estado' => $this->faker->randomElement(['vigente', 'vencida', 'suspendida']),
            'registrado_por' => $this->faker->name, 
        ];
    }
}