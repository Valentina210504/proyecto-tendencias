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
        $recorrido = $this->faker->optional()->randomFloat(2, 10, 500); 
        $costoTotal = $recorrido ? $recorrido * $this->faker->randomFloat(2, 1000, 3000) : null;

        return [
            'vehiculo_id' => Vehiculo::inRandomOrder()->first()->id,   
            'conductor_id' => Conductor::inRandomOrder()->first()->id, 
            'ruta_id' => Ruta::inRandomOrder()->first()->id,            
            'descripcion' => $this->faker->optional()->sentence(8),
            'recorrido' => $recorrido,
            'tiempo_estimado' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'costo_total' => $costoTotal,
            'estado' => $this->faker->randomElement(['programado', 'en curso', 'finalizado', 'cancelado']),
            'registrado_por' => $this->faker->name,
        ];
    }
}