<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehiculo;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recarga_Combustible>
 */
class Recarga_CombustibleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            $cantidadLitros = $this->faker->randomFloat(2, 5, 100);
            $precioLitro = $this->faker->randomFloat(2, 0.8, 2.5);
        return [
            'cantidad_litros' => $cantidadLitros,
            'precio_litro' => $precioLitro,
            'costo_total' => $cantidadLitros * $precioLitro,
            'estacion_servicio' => $this->faker->company . ' Gasolinera',
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'registrado_por' => $this->faker->name,
        ];
    }
}