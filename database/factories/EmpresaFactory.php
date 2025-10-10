<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Empresa;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nit' => $this->faker->unique()->numerify('#########-#'), // formato NIT
            'nombre' => $this->faker->company,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->companyEmail,
            'estado' => $this->faker->randomElement(['activa', 'inactiva']),
            'registrado_por' => $this->faker->name,
        ];
    }
}