<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marca_id')->constrained('marcas');
            $table->foreignId('tipo_vehiculo_id')->constrained('tipo_vehiculos');
            $table->string('placa')->unique();
            $table->string('modelo');
            $table->year('año');
            $table->string('color');
            $table->integer('kilometraje');
            $table->boolean('estado')->default(true);
            $table->unsignedBigInteger('registrado_por')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};