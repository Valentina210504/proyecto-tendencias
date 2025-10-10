<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Marca;
use App\Models\Tipo_Vehiculo;
use App\Models\Vehiculo;
use App\Models\Recarga_Combustible;
use App\Models\Ruta;
use App\Models\Conductor;
use App\Models\Licencia;
use App\Models\Conductor_Licencia;
use App\Models\Contrato;
use App\Models\Conductor_Contrato;
use App\Models\Empresa;
use App\Models\Viaje;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Marca::factory(10)->create();
        Tipo_Vehiculo::factory(10)->create();
        Vehiculo::factory(10)->create();
        Recarga_Combustible::factory(10)->create();
        Ruta::factory(10)->create();
        Conductor::factory(10)->create();
        Licencia::factory(10)->create();
        Conductor_Licencia::factory(10)->create();
        Contrato::factory(10)->create();
        Conductor_Contrato::factory(10)->create();
        Viaje::factory(10)->create();
        Empresa::factory(10)->create();
        
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}