<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehiculo_id')->constrained('vehiculos');
            $table->foreignId('conductor_id')->constrained('conductores');
            $table->foreignId('ruta_id')->constrained('rutas');
            $table->string('descripcion')->nullable();
            $table->decimal('recorrido', 10, 2)->nullable();
            $table->dateTime('tiempo_estimado');
            $table->decimal('costo_total', 10, 2)->nullable();
            $table->string('estado');
            $table->string('registrado_por');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};