<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehiculo;
use App\Models\Conductor;
use App\Models\Ruta;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Viaje>
 */
class ViajeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $recorrido = $this->faker->optional()->randomFloat(2, 10, 500); // km recorridos
        $costoTotal = $recorrido ? $recorrido * $this->faker->randomFloat(2, 1000, 3000) : null;

        return [
            'vehiculo_id' => Vehiculo::factory(),   // Crea un vehículo si no existe
            'conductor_id' => Conductor::factory(), // Crea un conductor si no existe
            'ruta_id' => Ruta::factory(),           // Crea una ruta si no existe
            'descripcion' => $this->faker->optional()->sentence(8),
            'recorrido' => $recorrido,
            'tiempo_estimado' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'costo_total' => $costoTotal,
            'estado' => $this->faker->randomElement(['programado', 'en curso', 'finalizado', 'cancelado']),
            'registrado_por' => $this->faker->name,
        ];
    }
}