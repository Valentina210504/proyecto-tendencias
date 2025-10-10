<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tipo_Vehiculo>
 */
class Tipo_VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            'capacidad_pasajero' => $this->faker->numberBetween(1, 60),
            'capacidad_carga' => $this->faker->randomFloat(2, 0, 10000),
            'capacidad_gasolina' => $this->faker->randomFloat(2, 0, 100),
            'estado' => $this->faker->randomElement(['1', '0']),
            'registrado_por' => $this->faker->name()
        ];
    }
}