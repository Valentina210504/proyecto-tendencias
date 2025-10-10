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
        Schema::create('rutas', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_ruta');
        $table->string('descripcion')->nullable();
        $table->decimal('distancia_en_km', 10, 2);
        $table->time('tiempo_estimado')->nullable();
        $table->decimal('costo_peaje', 10, 2)->nullable();
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
        Schema::dropIfExists('rutas');
    }
};