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
        Schema::create('recarga_combustibles', function (Blueprint $table) {
            $table->id();
            $table->decimal('cantidad_litros', 10, 2);
            $table->decimal('precio_litro', 10, 2);
            $table->decimal('costo_total', 12, 2);
            $table->string('estacion_servicio');
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
        Schema::dropIfExists('recarga_combustibles');
    }
};