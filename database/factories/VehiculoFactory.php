<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tipo_Vehiculo;
use App\Models\Marca;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marca_id' => Marca::factory(),
            'tipo_vehiculo_id' => Tipo_Vehiculo::factory(),
            'placa' => strtoupper($this->faker->bothify('???-####')),
            'modelo' => $this->faker->word(),
            'año' => $this->faker->year(),
            'color' => $this->faker->safeColorName(),
            'kilometraje' => $this->faker->randomFloat(2, 0, 200000),
            'estado' => $this->faker->randomElement(['activo', 'inactivo', 'mantenimiento']),
            'registrado_por' => $this->faker->name()
        ];
    }
}